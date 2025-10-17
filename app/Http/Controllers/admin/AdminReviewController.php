<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\ReviewImage;
use App\Models\ReviewContent;
use App\Models\ReviewCategory;
use App\Models\Tab;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class AdminReviewController extends Controller
{
    public function index(Request $request)
    {
        // Fetch reviews with pagination, search filter, and sorting
        $search = $request->input('search', '');
        $pageLength = $request->input('pageLength', 10);

        $reviews = Review::with('category')
            ->where('ReviewsTitle', 'like', "%{$search}%")
            ->where('IsDeleted', 0)
            ->orderBy('PublishDate', 'desc')
            ->paginate($pageLength);

        return view('admin.reviews.index', compact('reviews', 'search', 'pageLength'));
    }

    // Show the form for creating a new review
    public function create()
    {
        // return the view for creating a review
            // Fetch Review Categories (these can be fetched similarly)
            $categories = ReviewCategory::where('IsActive', 1)->get();

            // Initially, set $tabs as empty
            $tabs = [];
        
            return view('admin.reviews.create', compact('categories', 'tabs'));
    }

    public function fetchCategory(Request $request)
    {
        $menuID = $request->input('menu_id');
        
        // Fetch categories based on MenuID
        $categories = ReviewCategory::where('IsActive', 1)
            ->where(function ($query) use ($menuID) {
                $query->where('MenuID', $menuID)
                    ->orWhere('MenuID', '9,11'); // for both Car and Bike
            })
            ->get();
    
        return response()->json($categories);
    }
    
    public function fetchTabsByMenuID(Request $request)
    {
        $menuID = $request->input('menu_id');
    
        // Fetch Tabs based on MenuID
        $tabs = Tab::where(function($query) use ($menuID) {
            $query->where('MenuID', $menuID)
                  ->orWhere('MenuID', '9,11'); // For both Car and Bike tabs
        })
        ->where('IsActive', 1)
        ->get();
    
        return response()->json($tabs);
    }

    // Store a new review
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'MenuID' => 'required|integer',
            'ReviewsCategoryID' => 'required|integer',
            'ReviewsTitle' => 'required|string|max:255',
            'Rating' => 'nullable|integer|max:10',
            'PunchLine' => 'string|max:255',
            'GoodStuff' => 'string',
            'BadStuff' => 'string',
            'MetaTitle' => 'nullable|string|max:60',
            'MetaDescription' => 'nullable|string|max:160',
            'Keyword' => 'nullable|string|max:255',
            'Author' => 'required|string|max:255',
            'PublishDate' => 'required|date',
            'IsActive' => 'required|boolean',
            'Thumbimage' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'Image.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:19096', // For multiple images
            'tabscontent.*' => 'nullable|string' // Content of tabs
        ]);


        $reviewData = $validatedData;
        $reviewData['MakeID'] = 0;  // Default value for now
        $reviewData['AttributeGroupID'] = 0;  // Default value for now
        $reviewData['ModelID'] = 0;  // Default value for now
        $reviewData['VariantID'] = 0;  // Default value for now
        $reviewData['ReviewsContent'] = ''; // Empty for now, handled in the tabs content
        $reviewData['IsDeleted'] = 0;
        $reviewData['IP'] = $request->ip();
        $reviewData['views'] = 0;


        // Handle Featured Image (Thumbimage)
        if ($request->hasFile('Thumbimage')) {
            $thumbImage = $request->file('Thumbimage');
            $thumbImageName = time() . '-' . $thumbImage->getClientOriginalName();
            $thumbImagePath = $thumbImage->move(public_path('uploads/Reviewsthumb/Image/'), $thumbImageName);
            $reviewData['ImagePath'] = 'uploads/Reviewsthumb/Image/' . $thumbImageName;
        }
        // Create and save the Review
        $review = Review::create($reviewData);

        if ($request->hasFile('Image')) {
            foreach ($request->file('Image') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $imagePath = $image->move(public_path('uploads/Reviews/Image/'), $imageName);

                // Save image to ReviewImage table
                ReviewImage::create([
                    'ReviewsID' => $review->ReviewsID,
                    'ImagePath' => 'uploads/Reviews/Image/' . $imageName,
                    'ImageName' => 'Review Image',
                    'Title' => 'Review Image',
                ]);
            }
        }

        if ($request->has('tabscontent')) {
            foreach ($request->input('tabscontent') as $tabID => $content) {
                // Only save tabs with non-empty content
                if (!empty(trim($content))) {
                    ReviewContent::create([
                        'ReviewsID' => $review->ReviewsID,
                        'TabID' => $tabID,
                        'Content' => $content
                    ]);
                }
            }
        }
        if ($review->IsActive == 1) {
            $this->updateSitemap($review);
        }

        // Flash success message and redirect
        Session::flash('succ_msg', 'Review created successfully.');
        return redirect()->route('adminreviews.index');
    }

    protected function updateSitemap($review)
    {
        $categoryMap = [
            9 => 'cars',
            11 => 'bikes',
            // Add other categories if needed
        ];
        $category = $categoryMap[$review->MenuID] ?? 'others';
        $url = url("/reviews/$category/{$review->Code}");
        $lastmod = date('Y-m-d', strtotime($review->PublishDate));
        $priority = '0.64';

        // Prepare the sitemap entry
        $sitemapEntry = "
        <url>
            <loc>$url</loc>
            <lastmod>$lastmod</lastmod>
            <priority>$priority</priority>
        </url>";

        // Path to sitemap file
        $sitemapPath = public_path('reviews-sitemap.xml');

        if (file_exists($sitemapPath)) {
            $sitemapContent = file_get_contents($sitemapPath);
            $sitemapContent = preg_replace('/(<urlset[^>]*>)/', "$1\n$sitemapEntry", $sitemapContent);
            file_put_contents($sitemapPath, $sitemapContent);
        }
    }







    // Show the form for editing a review
    public function edit($id)
    {
        $review = Review::findOrFail($id);
    
        // Retrieve related images
        $images = ReviewImage::where('ReviewsID', $review->ReviewsID)->get();
        
        // Retrieve tab contents for the review
        $tabContents = ReviewContent::where('ReviewsID', $review->ReviewsID)->get();
        
        // Fetch review categories
        $categories = ReviewCategory::where('IsActive', 1)->get();
        
        // Fetch tabs based on the review's MenuID
        $tabs = Tab::where(function($query) use ($review) {
            $query->where('MenuID', $review->MenuID)
                  ->orWhere('MenuID', '9,11'); // For both Car and Bike tabs
        })->where('IsActive', 1)->get();
    
        // Return the edit view with the review data
        return view('admin.reviews.edit', compact('review', 'categories', 'images', 'tabContents', 'tabs'));
    }

    // Update the review
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'MenuID' => 'required|integer',
            'ReviewsCategoryID' => 'required|integer',
            'ReviewsTitle' => 'required|string|max:255',
            'Rating' => 'nullable|integer|max:10',
            'PunchLine' => 'required|string|max:255',
            'GoodStuff' => 'required|string',
            'BadStuff' => 'required|string',
            'MetaTitle' => 'nullable|string|max:60',
            'MetaDescription' => 'nullable|string|max:160',
            'Keyword' => 'nullable|string|max:255',
            'Author' => 'nullable|string|max:255',
            'PublishDate' => 'required|date',
            'IsActive' => 'required|boolean',
            'Thumbimage' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'Image.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:9096',
            'tabscontent.*' => 'nullable|string'
        ]);
    
        // Fetch the existing review
        $review = Review::findOrFail($id);
        $validatedData['Author'] = $review->Author; // Keep old value

        // Update review data
        $review->fill($validatedData);
    
        // Handle Featured Image (Thumbimage)
        if ($request->hasFile('Thumbimage')) {
            $thumbImage = $request->file('Thumbimage');
            $thumbImageName = time() . '-' . $thumbImage->getClientOriginalName();
            $thumbImagePath = $thumbImage->move(public_path('uploads/Reviewsthumb/Image/'), $thumbImageName);
            $review->ImagePath = 'uploads/Reviewsthumb/Image/' . $thumbImageName;
        }
    
        // Save the updated review
        $review->save();
    
        // Handle Slider Images
        if ($request->hasFile('Image')) {
            // Remove old images
            ReviewImage::where('ReviewsID', $review->ReviewsID)->delete();
            
            foreach ($request->file('Image') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $imagePath = $image->move(public_path('uploads/Reviews/Image/'), $imageName);
    
                // Save new images
                ReviewImage::create([
                    'ReviewsID' => $review->ReviewsID,
                    'ImagePath' => 'uploads/Reviews/Image/' . $imageName,
                    'ImageName' => 'Review Image',
                    'Title' => 'Review Image',
                ]);
            }
        }
    
        // Handle Tab Contents
        if ($request->has('tabscontent')) {
            // Delete old tab content
            ReviewContent::where('ReviewsID', $review->ReviewsID)->delete();
            
            foreach ($request->input('tabscontent') as $tabID => $content) {
                // Only save tabs with non-empty content
                if (!empty(trim($content))) {
                    ReviewContent::create([
                        'ReviewsID' => $review->ReviewsID,
                        'TabID' => $tabID,
                        'Content' => $content
                    ]);
                }
            }
        }
    
        // Flash success message and redirect
        Session::flash('succ_msg', 'Review updated successfully.');
        return redirect()->route('adminreviews.index');
    }

    // Delete a review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->IsDeleted = 1;
        $review->save();
        return redirect()->route('adminreviews.index')->with('succ_msg', 'Review deleted successfully.');
    }
}
