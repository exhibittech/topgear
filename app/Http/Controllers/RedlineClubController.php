<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedlineClubController extends Controller
{
    /**
     * Display the Redline Club static page.
     */
    public function redlineclub()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'Redline Club | TopGear India',
            'MetaDescription' => 'Join the Redline Club',
            'Keyword' => 'Redline Club, TopGear India, Car Enthusiasts'
        ];

        return view('redlineclub', compact('seodata', 'menu'));
    }
}