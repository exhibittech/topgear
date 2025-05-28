<?php

namespace App\Http\Controllers;

use App\Models\Electric;
use App\Models\ElectricImage;
use Illuminate\Support\Facades\DB;

class ElectricController extends Controller
{
    public function list()
    {
        $menu = MenuController::loadMenu();

        $electricList = Electric::where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->orderBy('PublishDate', 'DESC')
            ->paginate(9);

        $seodata = [
            'MetaTitle' => 'Latest Electric Vehicle News & Reviews | BBC Topgear India Magazine',
            'MetaDescription' => "TopGear India brings you the most up-to-date news and reviews of electric vehicles. Find out what's new and upcoming in the electric automotive industry from the world's best-known auto magazine.",
            'Keyword' => 'electric vehicle news, electric car reviews, electric bike reviews, top gear electric vehicle, automotive electric news',
        ];

        return view('electric.list', compact('electricList', 'seodata', 'menu'));
    }

    public function details($code)
    {
        $menu = MenuController::loadMenu();

        $record = Electric::where('Code', $code)->firstOrFail();
        $images = ElectricImage::where('ElectricID', $record->ElectricID)->get();

        $increment = rand(1, 15);
        DB::table('Electric')
            ->where('ElectricID', $record->ElectricID)
            ->increment('views', $increment);

        $breadcrumbs = [
            (object) ['title' => ucwords(str_replace(' ', '-', 'electric')), 'link' => '', 'separetor' => '/'],
            (object) ['title' => $record->Name, 'link' => '#', 'separetor' => ''],
        ];

        $relatedArticles = Electric::where('ElectricID', '!=', $record->ElectricID)
            ->where('IsDeleted', 0)
            ->orderBy('PublishDate', 'DESC')
            ->take(3)
            ->get();

        $seodata = [
            'MetaTitle' => $record->MetaTitle ?? 'Latest Electric Vehicle News & Reviews | BBC Topgear India Magazine',
            'MetaDescription' => $record->MetaDescription ?? "TopGear India brings you the most up-to-date news and reviews of electric vehicles. Find out what's new and upcoming in the electric automotive industry from the world's best-known auto magazine.",
            'Keyword' => $record->Keyword ?? 'electric vehicle news, electric car reviews, electric bike reviews, top gear electric vehicle, automotive electric news',
        ];

        return view('electric.details', compact('record', 'images', 'breadcrumbs', 'relatedArticles', 'seodata', 'menu'));
    }
}
