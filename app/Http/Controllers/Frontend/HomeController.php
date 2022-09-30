<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Http\Controllers\Controller;

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

        return view($theme_path_home,[
            'posts' => $posts,
            'tags' => $tags,
            'related_posts' => $related_posts,
        ]);
    }
}
