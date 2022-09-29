<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function show(Post $post)
    {
        
        $theme_path_home = 'themes.' . config('value.THEME_NAME') . '.content.post';
        return view($theme_path_home,['post'=> $post] );
    }
}
