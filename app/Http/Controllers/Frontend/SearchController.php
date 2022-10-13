<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        SEOMeta::setRobots('noindex');
        SEOMeta::getRobots();
        
        $theme_path_search = 'themes.' . config('value.THEME_NAME') . '.content.search';
        return view($theme_path_search);
    }
}
