<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Review;
use App\Models\ReviewCategory;
use App\Models\ReviewContent;
use App\Models\ReviewImage;
use App\Models\Tab;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function menu($menuCode)
    {
        $menu = MenuController::loadMenu();
        $menuData = Menu::where('Code', $menuCode)->firstOrFail();

        $categories = ReviewCategory::whereRaw('FIND_IN_SET(?, MenuID)', [$menuData->ID])->get();

        $categories->each(function ($category) use ($menuData) {
            $category->reviews = Review::where('IsDeleted', 0)
                ->where('IsActive', 1)
                ->where('ReviewsCategoryID', $category->ID)
                ->where('MenuID', $menuData->ID)
                ->orderBy('PublishDate', 'DESC')
                ->take(6)
                ->get();
        });

        $seodata = [
            'MetaTitle' => 'Latest Car & Bike Reviews | BBC Topgear India Magazine',
            'MetaDescription' => "TopGear India brings you the most up-to-date reviews of car & bike. Find out what's new and upcoming in automotive industry from the world's best-known auto magazine.",
            'Keyword' => 'topgear india, car reviews, bike reviews, automotive reviews, latest car reviews, latest bike reviews',
        ];

        return view('reviews.menu', compact('categories', 'seodata', 'menu', 'menuData'));
    }

    public function category($menuCode, $categoryCode)
    {

        
        $menu = MenuController::loadMenu();
        $menuData = Menu::where('Code', $menuCode)->firstOrFail();
        $category = ReviewCategory::where('Code', $categoryCode)->firstOrFail();
        
        $reviewsList = Review::with(['category', 'menu', 'images'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->where('MenuID', $menuData->ID)
            ->where('ReviewsCategoryID', $category->ID)
            ->orderBy('PublishDate', 'DESC')
            ->paginate(9);
        $seodata = [
            'MetaTitle' => 'Latest Car & Bike Reviews | BBC Topgear India Magazine',
            'MetaDescription' => "TopGear India brings you the most up-to-date reviews of car & bike. Find out what's new and upcoming in automotive industry from the world's best-known auto magazine.",
            'Keyword' => 'topgear india, car reviews, bike reviews, automotive reviews, latest car reviews, latest bike reviews',
        ];

        return view('reviews.list', compact('reviewsList', 'seodata', 'menu', 'category', 'menuData'));
    }

    public function details($menuCode, $categoryCode, $code, $tabCode = 'overview')
    {
        $menu = MenuController::loadMenu();

        // Retrieve the main review record based on the provided code
        $record = Review::where('Code', $code)->firstOrFail();

        // Retrieve associated images ordered by DisplayOrder
        $images = ReviewImage::where('ReviewsID', $record->ReviewsID)
            ->orderBy('DisplayOrder', 'asc')
            ->get();

        // Increment the view count by a random number between 1 and 15
        $increment = rand(1, 15);
        DB::table('Reviews')
            ->where('ReviewsID', $record->ReviewsID)
            ->increment('views', $increment);

        // Fetch the updated view count
        $views = Review::where('ReviewsID', $record->ReviewsID)->value('views');

        // Set up breadcrumbs for the page navigation
        $breadcrumbs = [
            (object) ['title' => 'Reviews', 'link' => '', 'separetor' => '/'],
            (object) ['title' => ucwords(str_replace('-', ' ', $categoryCode)), 'link' => '', 'separetor' => '/'],
            (object) ['title' => $record->ReviewsTitle, 'link' => '#', 'separetor' => ''],
        ];

        // Fetch all relevant tabs for the review's menu
       // Fetch relevant content for the current review
    $tabContents = ReviewContent::where('ReviewsID', $record->ReviewsID)->get();

    // Collect Tab IDs from ReviewContent
    $tabIDs = $tabContents->pluck('TabID')->toArray();

    // Fetch Tabs that match these IDs (we filter by TabID)
    $tabs = Tab::whereIn('TabID', $tabIDs)->get();

    // Find the currently selected tab by Code
    $selectedTab = $tabs->where('Code', $tabCode)->first();

    // Determine next and previous tabs
    $currentTabIndex = $tabs->search(function ($t) use ($tabCode) {
        return $t->Code === $tabCode;
    });
    $nextTab = $tabs->get($currentTabIndex + 1);
    $prevTab = $tabs->get($currentTabIndex - 1);
        // Retrieve related articles
        $relatedArticles = Review::with(['category', 'menu'])
            ->where('ReviewsCategoryID', $record->ReviewsCategoryID)
            ->where('ReviewsID', '!=', $record->ReviewsID)
            ->where('IsDeleted', 0)
            ->orderBy('PublishDate', 'DESC')
            ->take(3)
            ->get();

        // SEO data
        $seodata = [
            'MetaTitle' => $record->MetaTitle ?? 'Latest Car & Bike Reviews | BBC Topgear India Magazine',
            'MetaDescription' => $record->MetaDescription ?? "TopGear India brings you the most up-to-date reviews of car & bike. Find out what's new and upcoming in automotive industry from the world's best-known auto magazine.",
            'Keyword' => $record->Keyword ?? 'topgear india, car reviews, bike reviews, automotive reviews, latest car reviews, latest bike reviews',
        ];

        return view('reviews.details', compact(
            'record', 'images', 'breadcrumbs', 'relatedArticles',
            'seodata', 'menu', 'menuCode', 'categoryCode', 'tabs', 'tabContents',
            'selectedTab', 'nextTab', 'prevTab', 'views'
        ));
    }
}
