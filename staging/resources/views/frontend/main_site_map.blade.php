<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
           @foreach ($filePathVals as $filePath)
                <sitemap>
                    <loc>{{ url($filePath) }}</loc>
                </sitemap>
            @endforeach
</urlset>