<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{
    protected  $limit = 3;
    public function home()
    {
        $posts = Post::with(['user','tags'])
        ->where('status','publish')
        ->select('id','user_id','post_title','slug','post_description','updated_at')
        ->limit(config('value.Home_Page_Post_Count'))
        ->simplePaginate($this->limit);

        if ($posts->isEmpty()) {
            return "Please Scrape Some Post";
        }

        $theme_path_home = 'themes.' . config('value.THEME_NAME') . '.content.home';
      
        foreach ($posts as $post) {
            foreach ($post->tags as $tag) {
                $tags['name'][] =  $tag->name;  
                $tags['slug'][] =  $tag->slug;  
                $tag_type = $tag->type; 
            }
        }        
        
         $related_posts  = Post::withAnyTags($tags['name'], $tag_type)
         ->select('slug','post_title')
         ->where('status','publish')
         ->limit(config('value.RELATED_POSTS_COUNT'))
         ->get();

         $settings    = nova_get_settings();

         SEOTools::setTitle($settings['home_title']);
         SEOTools::setDescription(Str::words($settings['home_page_description']));
         SEOTools::opengraph()->setUrl(URL::current());
         SEOTools::setCanonical(URL::current());

        return view($theme_path_home,[
            'posts' => $posts,
            'related_tags' => $tags,
            'related_posts' => $related_posts,
        ]);
    }
}
