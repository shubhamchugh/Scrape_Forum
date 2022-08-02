<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {

        $theme_path_home = 'themes.' . config('app.THEME_NAME') . '.content.home';
        
        Post::paginatio
        dd("pass");
    }
}
