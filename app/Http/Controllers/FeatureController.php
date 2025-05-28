<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\FeatureCategory;
use App\Models\FeatureImage;
use Illuminate\Support\Facades\DB;

class FeatureController extends Controller
{
    public function category($categoryCode)
    {
        $menu = MenuController::loadMenu();
        $category = FeatureCategory::where('Code', $categoryCode)->firstOrFail();

        $featureList = Feature::with(['category', 'menu', 'images'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->where('ID', $category->ID)
            ->orderBy('PublishDate', 'DESC')
            ->paginate(12);

        $seodata = [
            'MetaTitle' => 'Latest Car & Bike Features | BBC Topgear India Magazine',
            'MetaDescription' => "TopGear India brings you the most up-to-date features on cars & bikes. Find out what's new and upcoming in automotive industry from the world's best-known auto magazine.",
            'Keyword' => 'topgear india features, car features, bike features, top gear india magazine features, automotive features',
        ];

        return view('features.list', compact('featureList', 'seodata', 'menu', 'category'));
    }

    public function details($category, $code)
    {
        $menu = MenuController::loadMenu();

        $record = Feature::where('Code', $code)->firstOrFail();
        $images = FeatureImage::where('FeatureID', $record->FeatureID)->get();

        $increment = rand(1, 15);
        DB::table('Features')
            ->where('FeatureID', $record->FeatureID)
            ->increment('views', $increment);

        $breadcrumbs = [
            (object) ['title' => ucwords(str_replace(' ', '-', 'features')), 'link' => '', 'separetor' => '/'],
            (object) ['title' => ucwords(str_replace(' ', '-', $category)), 'link' => '', 'separetor' => '/'],
            (object) ['title' => $record->Name, 'link' => '#', 'separetor' => ''],
        ];

        $relatedArticles = Feature::with(['category', 'menu', 'images'])
            ->where('ID', $record->ID)
            ->where('FeatureID', '!=', $record->FeatureID)
            ->where('IsDeleted', 0)
            ->orderBy('PublishDate', 'DESC')
            ->take(3)
            ->get();

        $seodata = [
            'MetaTitle' => $record->MetaTitle ?? 'Latest Car & Bike Features | BBC Topgear India Magazine',
            'MetaDescription' => $record->MetaDescription ?? "TopGear India brings you the most up-to-date features on cars & bikes. Find out what's new and upcoming in automotive industry from the world's best-known auto magazine.",
            'Keyword' => $record->Keyword ?? 'topgear india features, car features, bike features, top gear india magazine features, automotive features',
        ];

        return view('features.details', compact('record', 'images', 'breadcrumbs', 'relatedArticles', 'seodata', 'menu'));
    }
}
