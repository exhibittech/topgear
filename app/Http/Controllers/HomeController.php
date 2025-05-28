<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\News;
use App\Models\Review;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $menu = MenuController::loadMenu();

        $homecontent = News::with(['category', 'menu', 'images'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->orderBy('PublishDate', 'DESC')
            ->take(9)
            ->get();

        $reviewslisthome = Review::with(['category', 'menu', 'images'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->orderBy('PublishDate', 'DESC')
            ->take(9)
            ->get();

        $featurelisthome = Feature::with(['category', 'menu', 'images'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->orderBy('PublishDate', 'DESC')
            ->take(9)
            ->get();

        $thirtyDaysAgo = Carbon::now()->subDays(30);

        $trendingNews = News::with(['category', 'menu'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->where('PublishDate', '>=', $thirtyDaysAgo)
            ->orderBy('views', 'DESC')
            ->get();

        $trendingReviews = Review::with(['category', 'menu'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->where('PublishDate', '>=', $thirtyDaysAgo)
            ->orderBy('views', 'DESC')
            ->get();

        $trendingFeatures = Feature::with(['category', 'menu'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->where('PublishDate', '>=', $thirtyDaysAgo)
            ->orderBy('views', 'DESC')
            ->get();

        $trendingdata = collect($trendingNews)
            ->merge($trendingReviews)
            ->merge($trendingFeatures)
            ->sortByDesc('views')
            ->take(6);

        $bannerNews = News::with(['category', 'menu', 'images'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->orderBy('PublishDate', 'DESC')
            ->take(9)
            ->get();

        $bannerReviews = Review::with(['category', 'menu', 'images'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->orderBy('PublishDate', 'DESC')
            ->take(9)
            ->get();

        $bannerFeatures = Feature::with(['category', 'menu', 'images'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->orderBy('PublishDate', 'DESC')
            ->take(9)
            ->get();

        $mergedBanner = collect($bannerNews)
            ->merge($bannerReviews)
            ->merge($bannerFeatures)
            ->sortByDesc('PublishDate')
            ->take(7);

        $seodata = [
            'MetaTitle' => 'Latest Car & Bike News & Reviews | BBC Topgear India Magazine',
            'MetaDescription' => "TopGear India brings you the most up-to-date news and reviews of car & bike. Find out what's new and upcoming in automotive industry from the world's best-known auto magazine.",
            'Keyword' => 'topgear india, topgear, top gear india, mini topgear india, topgear india awards, top gear india special, MG gloster topgear india, topgear india magazine, 4th topgear india awards, topgear india awards 2023, topgear india awards 2024, bbc topgear india, classic indian car, dulquer salmaan at topgear india awards, topgearmag india, dulquer salmaan topgear, dq salmaan at topgear india awards 2023, dq salmaan at bbc topgear india awards 2023, dq salmaan topgear, automotive news, car news, car manufacturers automobile industry, best car repairs near me, hybrid vehicle, electric vehicles, ev cars, ev bikes, sports car india, suv india, automobile insurance, automotive magazine, Latest new of cars, latest new of bikes, review of cars, review of bike, auto site, luxury car review, new launching of car and bike, off roading car review',
        ];

        return view('home', compact('menu', 'homecontent', 'reviewslisthome', 'featurelisthome', 'trendingdata', 'mergedBanner', 'seodata'));
    }
}
