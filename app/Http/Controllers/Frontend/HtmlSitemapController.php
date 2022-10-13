<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HtmlSitemapController extends Controller
{
    public function sitemap($sitemap)
    {
       
        $sitemap_letter     = $sitemap;
        
        $theme_path_sitemap = 'themes.' . config('value.THEME_NAME') . '.content.sitemap';

        $sitemap = Post::where("slug", "like", "$sitemap%")
        ->paginate(config('value.SITEMAP_PAGE_COUNT'));

        return view($theme_path_sitemap, [
            'sitemap'        => $sitemap,
            'sitemap_letter' => $sitemap_letter,
        ]);
    }

}
