<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Spatie\Tags\Tag;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;

class TagController extends Controller
{
    public function TagShow($tag)
    {
            
        $tagName = Tag::whereJsonContains('slug->en', 'typescript')->first();
        
      
        $related_posts = NUll;
        $tags = Null;
        $theme_path_home = 'themes.' . config('value.THEME_NAME') . '.content.tags';

        $posts = Post::withAnyTags([$tagName->name], 'QA')
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
             SEOTools::setTitle($tagName->name . ' Related Question Answers');
             SEOTools::opengraph()->setUrl(URL::current());
             SEOTools::setCanonical(URL::current());

            return view($theme_path_home,[
                'posts' => $posts,
                'related_tags' => $tags,
                'related_posts' => $related_posts,]);
    }
}
