<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsImage;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function category($categoryCode)
    {
        $menu = MenuController::loadMenu();

        $category = NewsCategory::where('Code', $categoryCode)->firstOrFail();

        $newsList = News::with(['category', 'menu', 'images'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->where('ID', $category->ID)
            ->orderBy('PublishDate', 'DESC')
            ->paginate(12);

        $seodata = [
            'MetaTitle' => 'Latest Car & Bike News & Reviews | BBC Topgear India Magazine',
            'MetaDescription' => "TopGear India brings you the most up-to-date news and reviews of car & bike. Find out what's new and upcoming in automotive industry from the world's best-known auto magazine.",
            'Keyword' => 'topgear india, topgear, top gear india, mini topgear india, topgear india awards, top gear india special, MG gloster topgear india, topgear india magazine, 4th topgear india awards, topgear india awards 2023, topgear india awards 2024, bbc topgear india, classic indian car, dulquer salmaan at topgear india awards, topgearmag india, dulquer salmaan topgear, dq salmaan at topgear india awards 2023, dq salmaan at bbc topgear india awards 2023, dq salmaan topgear, automotive news, car news, car manufacturers automobile industry, best car repairs near me, hybrid vehicle, electric vehicles, ev cars, ev bikes, sports car india, suv india, automobile insurance, automotive magazine, Latest new of cars, latest new of bikes, review of cars, review of bike, auto site, luxury car review, new launching of car and bike, off roading car review',
        ];

        return view('news.list', compact('newsList', 'seodata', 'menu', 'category'));
    }

    public function details($category, $code)
    {
        $menu = MenuController::loadMenu();

        $record = News::where('Code', $code)->firstOrFail();

	//if ($record->category->Code !== $category) {
          //abort(404); // Return 404 if the category doesn't match
    	//}
	if ($record->category->Code !== $category) {
        // Redirect to the correct URL with the right category
        return redirect()->route('news.details', [
            'category' => $record->category->Code,
            'code' => $code,
        ], 301); // Use 301 for permanent redirection
    }
        $images = NewsImage::where('NewsID', $record->NewsID)->get();

        $increment = rand(1, 15);
        DB::table('News')
            ->where('NewsID', $record->NewsID)
            ->increment('views', $increment);

        $breadcrumbs = [
            (object) ['title' => ucwords(str_replace(' ', '-', 'news')), 'link' => '', 'separetor' => '/'],
            (object) ['title' => ucwords(str_replace(' ', '-', $category)), 'link' => '', 'separetor' => '/'],
            (object) ['title' => $record->Name, 'link' => '#', 'separetor' => ''],
        ];

        $relatedArticles = News::with(['category', 'menu', 'images'])
            ->where('ID', $record->ID)
            ->where('NewsID', '!=', $record->NewsID)
            ->where('IsDeleted', 0)
	->where('IsActive', 1)
            ->orderBy('PublishDate', 'DESC')
            ->take(3)
            ->get();

        $seodata = [
            'MetaTitle' => $record->MetaTitle ?? 'Latest Car & Bike News & Reviews | BBC Topgear India Magazine',
            'MetaDescription' => $record->MetaDescription ?? "TopGear India brings you the most up-to-date news and reviews of car & bike. Find out what's new and upcoming in automotive industry from the world's best-known auto magazine.",
            'Keyword' => $record->Keyword ?? 'topgear india, topgear, top gear india, mini topgear india, topgear india awards, top gear india special, MG gloster topgear india, topgear india magazine, 4th topgear india awards, topgear india awards 2023, topgear india awards 2024, bbc topgear india, classic indian car, dulquer salmaan at topgear india awards, topgearmag india, dulquer salmaan topgear, dq salmaan at topgear india awards 2023, dq salmaan at bbc topgear india awards 2023, dq salmaan topgear, automotive news, car news, car manufacturers automobile industry, best car repairs near me, hybrid vehicle, electric vehicles, ev cars, ev bikes, sports car india, suv india, automobile insurance, automotive magazine, Latest new of cars, latest new of bikes, review of cars, review of bike, auto site, luxury car review, new launching of car and bike, off roading car review',
        ];

        return view('news.details', compact('record', 'images', 'breadcrumbs', 'relatedArticles', 'seodata', 'menu'));
    }
}
