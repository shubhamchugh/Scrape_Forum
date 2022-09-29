<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $posts = Post::with('user')
        ->where('status','publish')
        ->select('id','user_id','post_title','slug','post_description','updated_at')
        ->limit(config('value.Home_Page_Post_Count'))
        ->get();
        $theme_path_home = 'themes.' . config('value.THEME_NAME') . '.content.home';
        
        return view($theme_path_home,[
            'posts' => $posts
        ]);
    }
}
