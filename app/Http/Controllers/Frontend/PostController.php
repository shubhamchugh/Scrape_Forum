<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class PostController extends Controller
{
      
    public function show(Post $post)
    {
        foreach ($post->tags as $tag) {
                $tags['name'][] =  $tag->name;  
                $tags['slug'][] =  $tag->slug;  
                $tag_type = $tag->type; 
        }
        
        $related_posts  = Post::withAnyTags($tags['name'], $tag_type)
        ->select('slug','post_title')
        ->where('status','publish')
        ->limit(config('value.RELATED_POSTS_COUNT'))
        ->get();
        
        $settings    = nova_get_settings();

        $theme_path_home = 'themes.' . config('value.THEME_NAME') . '.content.post';
        
            
        SEOTools::setTitle(ltrim($settings['title_prefix'] . ' ' . $post->post_title . ' ' . $settings['title_suffix']));
        SEOTools::setDescription(Str::words($post->post_description));
        SEOTools::opengraph()->setUrl(URL::current());
        SEOMeta::addMeta('article:published_time', optional($post->updated_at)->toW3CString(), 'property');
        SEOTools::setCanonical(URL::current());
        SEOTools::opengraph()->addProperty('type', 'articles');

        return view($theme_path_home,[
            'post'=> $post,
            'related_posts' => $related_posts,
            'related_tags' => $tags,
        ]);
    }
}
