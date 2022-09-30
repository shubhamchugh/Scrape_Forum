<?php

namespace App\View\Composers;

use App\Models\Post;
use Illuminate\View\View;

class NavbarView
{
    public function compose(View $view)
    {
        $this->composeNavbar($view);
    }

    public function composeNavbar(View $View)
    {
        $menusResponse = nova_get_menu_by_slug('header');
        $menus         = $menusResponse['menuItems'];
        
        $View->with([
            'menus' => $menus,
        ]);
    }
}