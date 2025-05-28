<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Review;
use App\Models\Feature;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $menu = MenuController::loadMenu();
        $searchQuery = $request->input('search');

        // Fetch matching records from News, Reviews, and Features without pagination
        $newsResults = News::with(['category', 'menu'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->where(function ($query) use ($searchQuery) {
                $query->where('Name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('Author', 'like', '%' . $searchQuery . '%');
            })
            ->get();

        $reviewResults = Review::with(['category', 'menu'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->where(function ($query) use ($searchQuery) {
                $query->where('ReviewsTitle', 'like', '%' . $searchQuery . '%')
                    ->orWhere('Author', 'like', '%' . $searchQuery . '%');
            })
            ->get();

        $featureResults = Feature::with(['category', 'menu'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->where(function ($query) use ($searchQuery) {
                $query->where('Name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('Author', 'like', '%' . $searchQuery . '%');
            })
            ->get();

        // Merge all results into a collection and sort by PublishDate
        $results = collect($newsResults)
            ->merge($reviewResults)
            ->merge($featureResults)
            ->sortByDesc('PublishDate');

        // Prepare SEO data
        $seodata = [
            'MetaTitle' => 'Search Results for: ' . $searchQuery,
            'MetaDescription' => 'Search results for ' . $searchQuery . ' in News, Reviews, and Features',
            'Keyword' => $searchQuery,
        ];

        return view('search.results', compact('results', 'searchQuery', 'menu', 'seodata'));
    }
}
