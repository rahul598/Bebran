<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\{
        Helpers\helpers
};
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Config;
use App\Models\Page;
use App\Models\PageExtra;

class SiteController extends Controller
{
     // Get Site Info (Logo, URLs, Contact)
    public function getSiteInfo()
    {
        $site_logo = config('site.logo') && File::exists(public_path('uploads/' . config('site.logo')))
            ? asset('uploads/' . config('site.logo'))
            : config('site.title');

        $site_mobilelogo = config('site.mobilelogo') && File::exists(public_path('uploads/' . config('site.mobilelogo')))
            ? asset('uploads/' . config('site.mobilelogo'))
            : $site_logo;

        $site_url = url('/');
        $phoneNumber = config('site.whatsapp');
        $encodedPhoneNumber = urlencode(str_replace(['+', '-'], '', $phoneNumber));

        return response()->json([
            'site_logo' => $site_logo,
            'site_mobilelogo' => $site_mobilelogo,
            'site_url' => $site_url,
            'whatsapp_link' => "https://api.whatsapp.com/send/?phone={$encodedPhoneNumber}&text=Hi",
            'phone' => config('site.phone'),
            'skype' => config('site.skype_link')
        ]);
    }
    
    // Retrieve Main Menu
    public function getMainMenu()
    {
        $main_menu = DB::table('pages')
            ->whereIn('display_in', [1, 6, 7, 9])
            ->where('parent_id', 0)
            ->orderBy('menu_order', 'asc')
            ->get();

        return response()->json($main_menu);
    }

    // Retrieve Mega Menu
    // public function getMegaMenu()
    // {
    //     $mega_menu = DB::table('pages')
    //         ->whereIn('display_in', [2, 8, 7, 10])
    //         ->where('parent_id', 0)
    //         ->orderBy('menu_order', 'asc')
    //         ->get();

    //     return response()->json($mega_menu);
    // }
    public function getMegaMenu()
    {
        $mega_menu = DB::table('pages')
            ->whereIn('display_in', [2, 8, 7, 10])
            ->where('parent_id', 0)
            ->orderBy('menu_order', 'asc')
            ->get();
    
        // Retrieve sub-menu items grouped by parent_id
        $sub_menus = DB::table('pages')
            ->whereIn('display_in', [2, 8, 7, 10])
            ->where('parent_id', '>', 0)
            ->orderBy('menu_order', 'asc')
            ->get()
            ->groupBy('parent_id');
    
        // Map main menu items and attach their respective sub-menus
        $menuItems = $mega_menu->map(function ($menu) use ($sub_menus) {
            return [
                'id' => $menu->id,
                'page_name' => $menu->page_name,
                'slug' => $menu->id == 1 ? '' : $menu->slug,
                'redirect_to' => $menu->redirect_to,
                'sub_menu' => $sub_menus->get($menu->id, collect())->map(function ($subMenu) {
                    return [
                        'id' => $subMenu->id,
                        'page_name' => $subMenu->page_name,
                        'slug' => $subMenu->id == 1 ? '' : $subMenu->slug,
                        'redirect_to' => $subMenu->redirect_to,
                    ];
                })->values()->toArray()
            ];
        });
    
        return response()->json($menuItems);
    }



    // Get Cart Items for Authenticated User
    public function getCartItems(Request $request)
    {
        $user = auth()->user();
        
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
    
        // Retrieve cart data for the authenticated user
        $cart_data = DB::table('cart_items')->where('client_id', $user->id)->get();
        
        // If there are no items, set total items and price to 0
        $total_items = $cart_data->count();
        $total_price = $cart_data->isEmpty() ? 0 : $cart_data->sum('price');
    
        return response()->json([
            'total_items' => $total_items,
            'cart_items' => $cart_data,
            'total_price' => $total_price
        ]);
    }

// footer api method
    public function getFooterInfo()
    {
        // Site information
        $site_logo = $this->getImagePath(config('site.logo'));
        $footer_logo = $this->getImagePath(config('site.footer_logo'), $site_logo);
        $payment_methods = $this->getImagePath(config('site.payment_methods'));
        $buy_with_confidence = $this->getImagePath(config('site.buy_with_confidence'));

        // Footer menus
        $footer_menu = get_fields_value_where('pages', "(display_in='5' or display_in='6' or display_in='7')", 'menu_order', 'asc');
        $footer_services_menu = get_fields_value_where('pages', "(display_in='3' or display_in='7' or display_in='10')", 'menu_order', 'asc');
        $footer_resources_menu = get_fields_value_where('pages', "(display_in='4' or display_in='7' or display_in='8' or display_in='9')", 'menu_order', 'asc');

        // WhatsApp contact
        $whatsapp_number = $this->encodePhoneNumber(config('site.whatsapp'));

        // Current URL segment-based service slug
        $service_slug = $this->getServiceSlug();

        // Country, City, and Business data
        $countries = getCountries()->groupBy(fn($item) => substr($item->key, -1));
        $cities = getCitiesData();
        $businesses = getBusinessData();

        return response()->json([
            'site_info' => [
                'logo' => $site_logo,
                'footer_logo' => $footer_logo,
                'payment_methods' => $payment_methods,
                'buy_with_confidence' => $buy_with_confidence,
                'whatsapp' => $whatsapp_number,
                'site_url' => url('/'),
            ],
            'footer_menus' => [
                'general' => $footer_menu,
                'services' => $footer_services_menu,
                'resources' => $footer_resources_menu,
            ],
            'service_slug' => $service_slug,
            'data' => [
                'countries' => $countries,
                'cities' => $cities,
                'businesses' => $businesses,
            ]
        ]);
    }

    private function getImagePath($configKey, $default = null)
    {
        if ($configKey && File::exists(public_path('uploads/' . $configKey))) {
            return asset('/uploads/' . $configKey);
        }
        return $default;
    }

    private function encodePhoneNumber($phoneNumber)
    {
        return urlencode(str_replace(['+', '-'], '', $phoneNumber));
    }

    private function getServiceSlug()
    {
        $urlSegments = explode('/', url()->current());
        $numSegments = count($urlSegments);

        if ($numSegments == 4) {
            return $urlSegments[3];
        } elseif ($numSegments == 5 || $numSegments == 6) {
            return $urlSegments[4];
        }

        return null;
    }
     
    public function showPage(Request $request, $slug)
{
    // Get the page by slug
    $page = Page::where('slug', $slug)->firstOrFail();

    // Initialize the data array to hold the page data
    $data = [];

    // Default items per page and current page
    $itemsPerPage = 3; // Default to 3 items per page
    $currentPage = $request->input('page', 1); // Get the current page number from the request

    // Calculate the offset and limit based on the current page
    $offset = ($currentPage - 1) * $itemsPerPage;
    $limit = $itemsPerPage;

    // Adjust pagination settings based on post type or specific page ID
    if ($page->posttype == 'service') {
        $itemsPerPage = 3;
    } elseif ($page->posttype == 'blog') {
        $itemsPerPage = 16;
    } elseif ($page->id == 30) {
        $itemsPerPage = 8;
    }

    // Recalculate offset and limit with updated items per page
    $offset = ($currentPage - 1) * $itemsPerPage;
    $limit = $itemsPerPage;

    // Handle the template logic based on page template
    if ($page->page_template == '11') {
        // Get SEO results for posttype 'seo' and status '1'
        $data['seo_results'] = Page::where('posttype', 'seo')->where('status', '1')->orderBy('id', 'ASC')->get();

        // Get blog data for the current page with the specific service_id
        $data['blogData'] = Page::where('posttype', 'blog')->where('status', 1)
                                ->where('service_id', $page->id)
                                ->orderBy('id', 'DESC')
                                ->offset($offset)
                                ->limit($limit)
                                ->get();

        // Get additional data for page extra information (type 18)
        $query_from = DB::table('pages_extra')->where('page_id', 1)->where('type', 18)->first();

        // Get package details based on price_widget
        $package = DB::table('digital_service_price_widget')->where('service_type', $page->price_widget)->get();
        $package1 = DB::table('digital_service_price_widget')
                        ->select('duration_id', 'plan_duration')
                        ->where('service_type', $page->price_widget)
                        ->groupBy('duration_id', 'plan_duration')
                        ->get();

        // Get feature data associated with the current page
        $feature_data1 = DB::table('service_price_widgets')->where('service_page_id', $page->id)->get();
        $feature_data = json_decode(json_encode($feature_data1), true); 

        // Convert the fetched data into an array
        $digital_package_price = json_decode(json_encode($package), true);
        $digital_package_price1 = json_decode(json_encode($package1), true);

        // Arrays to store categorized package data
        $data_new = $data1 = $data2 = $data3 = [];
        foreach ($digital_package_price as $key1 => $val1) {
            if ($val1['duration_id'] == 1) {
                $data_new[] = $this->mapPackageData($val1);
            }
            if ($val1['duration_id'] == 2) {
                $data1[] = $this->mapPackageData($val1);
            }
            if ($val1['duration_id'] == 3) {
                $data2[] = $this->mapPackageData($val1);
            }
            if ($val1['duration_id'] == 4) {
                $data3[] = $this->mapPackageData($val1);
            }
        }

        // Get small description for the price widget
        $small_description = DB::table('plan_description_price_widget')->where('service_type', $page->price_widget)->get();

        // Return the data as a JSON response (for API use)
        return response()->json([
            'page' => $page,
            'seo_results' => $data['seo_results'],
            'blogData' => $data['blogData'],
            'query_from' => $query_from,
            'digital_package_price' => $digital_package_price,
            'digital_package_price1' => $digital_package_price1,
            'data_new' => $data_new,
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'feature_data' => $feature_data,
            'small_description' => $small_description,
        ]);
    }

    // If the page template doesn't match, return some default data or handle accordingly
    return response()->json(['message' => 'Page template not found or not supported.'], 404);
}


    // Helper method to map package data
    private function mapPackageData($packageData)
    {
        return [
            'id' => $packageData['id'],
            'duration_id' => $packageData['duration_id'],
            'plan_name' => $packageData['plan_name'],
            'plan_duration' => $packageData['plan_duration'],
            'most_popular' => $packageData['most_popular'],
            'main_price' => $packageData['main_price'],
            'discount_price' => $packageData['discount_price'],
            'percentage' => $packageData['percentage'],
            'button_text' => $packageData['button_text'],
            'service_type' => $packageData['service_type'],
        ];
    }  
}