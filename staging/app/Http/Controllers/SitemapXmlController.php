<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\Page;
use App\Models\Business;
use Illuminate\Support\Facades\Storage;

class SitemapXmlController extends Controller

{
    public function siteMap()
{
    $cities = Cities::all();
    $business = Business::all();
    $pages = Page::whereIn('posttype', ['blog', 'page', 'service', 'pricing', 'seo', 'city-service', 'city-business-service', 'business-service'])->get();

    $sitemapData = [];
    $urlCount = 0;
    $sitemapCount = 1;
    $addedUrls = []; 

    foreach ($pages as $page) {
        $url = '';
        $lastmod = '';

        switch ($page->posttype) {
            case 'page':
            case 'service':
            case 'pricing':
                $url = url('/') . '/' . $page->slug;
                break;
            case 'blog':
                $url = url('/blog') . '/' . $page->slug;
                break;
            case 'seo':
                $url = url('/seo-result') . '/' . $page->slug;
                break;
            case 'city-service':
                foreach ($cities as $cityVal) {
                    $pagesData = Page::where('id', $page->service_parent_id)->first();
                    $url = url('/' . $cityVal->slug) . '/' . $pagesData->slug;
                    if (!in_array($url, $addedUrls)) { 
                        $sitemapData[] = ['url' => $url, 'lastmod' => $page->updated_at ? $page->updated_at->tz('UTC')->toAtomString() : ''];
                        $addedUrls[] = $url;
                        $urlCount++;
                        if ($urlCount >= 25000) {
                            $this->createSitemapFile($sitemapData, $sitemapCount);
                            $sitemapData = [];
                            $urlCount = 0;
                            $sitemapCount++;
                        }
                    }
                }
                break;
            case 'business-service':
                foreach ($business as $businessVal) {
                    $pagesData = Page::where('id', $page->service_parent_id)->first();
                    $url = url('/' . $pagesData->slug) . '/' . $businessVal->slug;
                    if (!in_array($url, $addedUrls)) { 
                        $sitemapData[] = ['url' => $url, 'lastmod' => $page->updated_at ? $page->updated_at->tz('UTC')->toAtomString() : ''];
                        $addedUrls[] = $url;
                        $urlCount++;
                        if ($urlCount >= 25000) {
                            $this->createSitemapFile($sitemapData, $sitemapCount);
                            $sitemapData = [];
                            $urlCount = 0;
                            $sitemapCount++;
                        }
                    }
                }
                break;
            case 'city-business-service':
                foreach ($cities as $cityVal) {
                    foreach ($business as $businessVal) {
                        $pagesData = Page::where('id', $page->service_parent_id)->first();
                        $url = url('/' . $cityVal->slug . '/' . $pagesData->slug) . '/' . $businessVal->slug;
                        if (!in_array($url, $addedUrls)) { // Check if URL already exists
                            $sitemapData[] = ['url' => $url, 'lastmod' => $page->updated_at ? $page->updated_at->tz('UTC')->toAtomString() : ''];
                            $addedUrls[] = $url; 
                            $urlCount++;
                            if ($urlCount >= 25000) {
                                $this->createSitemapFile($sitemapData, $sitemapCount);
                                $sitemapData = [];
                                $urlCount = 0;
                                $sitemapCount++;
                            }
                        }
                    }
                }
                break;
        }

        if ($url != '') {
            if (!in_array($url, $addedUrls)) { 
                $sitemapData[] = ['url' => $url, 'lastmod' => $lastmod];
                $addedUrls[] = $url; 
                $urlCount++;
                if ($urlCount >= 25000) {
                    $this->createSitemapFile($sitemapData, $sitemapCount);
                    $sitemapData = [];
                    $urlCount = 0;
                    $sitemapCount++;
                }
            }
        }
    }

    if (!empty($sitemapData)) {
        $this->createSitemapFile($sitemapData, $sitemapCount);
        $this->createMainSiteMapFile($sitemapCount);
    }

    return response()->download(base_path('sitemap.xml'));
}

        
        private function createSitemapFile($sitemapData, $sitemapCount)
        {
            $xmlContent = view('frontend.site_map', ['sitemapData' => $sitemapData])->render();
            $filePath = base_path("sitemap$sitemapCount.xml");
            file_put_contents($filePath, $xmlContent);
        }
       private function createMainSiteMapFile($sitemapCount)
        {
            $filePathVals = [];
            for ($i = 1; $i <= $sitemapCount; $i++) {
                $filePathVals[] = "sitemap$i.xml";
            }
            
            $xmlContent = view('frontend.main_site_map', ['filePathVals' => $filePathVals])->render();
            $new_filePath = base_path("sitemap.xml");
            file_put_contents($new_filePath, $xmlContent);
        }

    
}