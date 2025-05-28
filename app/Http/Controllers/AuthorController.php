<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Review;
use App\Models\Feature;

class AuthorController extends Controller
{
    public function show($author)
    {
        $menu = MenuController::loadMenu();

        // Fetch all content by the given author from News, Reviews, and Features
        $newsResults = News::with(['category', 'menu'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->where('Author', $author)
            ->get();

        $reviewResults = Review::with(['category', 'menu'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->where('Author', $author)
            ->get();

        $featureResults = Feature::with(['category', 'menu'])
            ->where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->where('Author', $author)
            ->get();

        // Merge all results and sort by PublishDate
        $results = collect($newsResults)
            ->merge($reviewResults)
            ->merge($featureResults)
            ->sortByDesc('PublishDate');

        // Prepare SEO data
        $seodata = [
            'MetaTitle' => 'Articles by ' . $author,
            'MetaDescription' => 'Find all articles, reviews, and features by ' . $author,
            'Keyword' => $author,
        ];

        return view('author.show', compact('results', 'author', 'menu', 'seodata'));
    }
}
