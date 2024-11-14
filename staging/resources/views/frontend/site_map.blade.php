        @if(!empty($sitemapData))
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
            @foreach ($sitemapData as $data)
                <url>
                    <loc>{{$data['url']}}</loc>
                    @if ($data['lastmod'])
                        <lastmod>{{$data['lastmod']}}</lastmod>
                    @endif
                </url>
            @endforeach
</urlset>
        @endif
