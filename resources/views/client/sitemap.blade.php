 
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<url>
<loc>https://www.quickindia.in/</loc>
<lastmod>2025-05-09T09:59:21+00:00</lastmod>
<priority>1.00</priority>
</url>
<url>
<loc>https://www.quickindia.in/about-us/</loc>
<lastmod>2025-05-09T09:59:21+00:00</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://www.quickindia.in/business-owners/</loc>
<lastmod>2025-05-09T09:59:21+00:00</lastmod>
<priority>0.80</priority>
</url>
 @foreach ($keywords as $keyword)
    <url>
        <loc>{{ url('/') }}/<?php echo generate_slug($keyword->keyword) ?></loc>
        <lastmod><?php  
      
        echo gmdate(DATE_ATOM,mktime(0,0,0,date('m',strtotime($keyword->updated_at)),date('d',strtotime($keyword->updated_at)),date('Y',strtotime($keyword->updated_at)) ));
        ?>
        </lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach 
     
    
</urlset>