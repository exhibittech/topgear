<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class MenuController extends Controller
{
    public static function loadMenu()
    {
        $menu = Menu::with(['submenus' => function ($query) {
            $query->where('IsActive', 1)
                ->where('IsDeleted', 0)
                ->orderBy('ID')
                ->with(['submenus' => function ($query) {
                    $query->where('IsActive', 1)
                        ->where('IsDeleted', 0)
                        ->orderBy('ID');
                }]);
        }])
            ->where('ParentID', 0)
            ->where('IsActive', 1)
            ->where('IsDeleted', 0)
            ->orderBy('ID')
            ->get();

        return $menu;
    }
}
