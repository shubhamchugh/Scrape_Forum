<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Http\Controllers\Controller;

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
        
        $theme_path_home = 'themes.' . config('value.THEME_NAME') . '.content.post';
        
        return view($theme_path_home,[
            'post'=> $post,
            'related_posts' => $related_posts,
            'related_tags' => $tags,
        ]);
    }
}
