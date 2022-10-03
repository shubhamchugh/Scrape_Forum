<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class TagController extends Controller
{
    public function TagShow($tag)
    {
        $tagName = Tag::where('')
      
        $related_posts = NUll;
        $tags = Null;
        $theme_path_home = 'themes.' . config('value.THEME_NAME') . '.content.home';

        $posts = Post::withAnyTags([$tagName], 'QA')
            ->with(['user','tags',])
            ->where('status','publish')
            ->select('id','user_id','slug','post_title','post_description','updated_at')
            ->limit(10)
            ->simplePaginate(10);

            if ($posts->isEmpty()) {
                return abort(404);
            }
            
        foreach ($posts as $post) {
            
            if (!($post->tags)->isEmpty()) {
                foreach ($post->tags as $tag) {
                    $tags['name'][] =  $tag->name;  
                    $tags['slug'][] =  $tag->slug;  
                    $tag_type = $tag->type; 
                    }
                    
                    $related_posts  = Post::withAnyTags([$tag->name], $tag_type)
                    ->select('slug','post_title')
                    ->where('status','publish')
                    ->limit(config('value.RELATED_POSTS_COUNT'))
                    ->get();
            }
        }

            return view($theme_path_home,[
                'posts' => $posts,
                'tags' => $tags,
                'related_posts' => $related_posts,]);
    }
}
