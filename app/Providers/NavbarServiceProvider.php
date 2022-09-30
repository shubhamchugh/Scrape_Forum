<?php

namespace App\Providers;

use App\View\Composers\NavbarView;
use Illuminate\Support\ServiceProvider;

class NavbarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $theme_path_home    = 'themes.' . config('value.THEME_NAME') . '.panels.navbar';
        view()->composer([
            $theme_path_home
        ], NavbarView::class);
    }
}
