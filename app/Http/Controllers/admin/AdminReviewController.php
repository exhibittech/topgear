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
            'Thumbimage' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3584|dimensions:min_width=1700,min_height=950',
            'Image' => 'nullable|array|max:30',
            'Image.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3584|dimensions:min_width=1400,min_height=800',
            'tabscontent.*' => 'nullable|string'
        ], [
            'Image.max' => 'You can upload up to 30 slider images per review.',
            'Thumbimage.dimensions' => 'Featured image must be at least 1900px wide and 1064px tall.',
            'Image.*.dimensions' => 'Slider images must be at least 1900px wide and 1064px tall.'
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
            $destinationDir = public_path('uploads/Reviewsthumb/Image/');
            $thumbImage->move($destinationDir, $thumbImageName);
            $absoluteThumbPath = $destinationDir . $thumbImageName;
            $webpAbsolutePath = $this->generateWebpVariant($absoluteThumbPath);

            if ($webpAbsolutePath && ($relative = $this->relativePublicPath($webpAbsolutePath))) {
                if ($webpAbsolutePath !== $absoluteThumbPath && file_exists($absoluteThumbPath)) {
                    @unlink($absoluteThumbPath);
                }
                $reviewData['ImagePath'] = $relative;
            } else {
                $reviewData['ImagePath'] = 'uploads/Reviewsthumb/Image/' . $thumbImageName;
            }
        }
        // Create and save the Review
        $review = Review::create($reviewData);

        if ($request->hasFile('Image')) {
            $order = 0;
            foreach ($request->file('Image') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $destinationDir = public_path('uploads/Reviews/Image/');
                $image->move($destinationDir, $imageName);
                $absoluteImagePath = $destinationDir . $imageName;
                $webpAbsolutePath = $this->generateWebpVariant($absoluteImagePath);
                $relativePath = 'uploads/Reviews/Image/' . $imageName;

                if ($webpAbsolutePath && ($relative = $this->relativePublicPath($webpAbsolutePath))) {
                    if ($webpAbsolutePath !== $absoluteImagePath && file_exists($absoluteImagePath)) {
                        @unlink($absoluteImagePath);
                    }
                    $relativePath = $relative;
                }

                ReviewImage::create([
                    'ReviewsID' => $review->ReviewsID,
                    'ImagePath' => $relativePath,
                    'ImageName' => 'Review Image',
                    'Title' => 'Review Image',
                    'DisplayOrder' => $order++
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
    
        // Retrieve related images ordered by DisplayOrder
        $images = ReviewImage::where('ReviewsID', $review->ReviewsID)
            ->orderBy('DisplayOrder', 'asc')
            ->get();
        
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
            'Thumbimage' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3584|dimensions:min_width=1700,min_height=950',
            'Image' => 'nullable|array|max:30',
            'Image.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3584|dimensions:min_width=1400,min_height=800',
            'tabscontent.*' => 'nullable|string'
        ], [
            'Image.max' => 'You can upload up to 30 slider images per review.',
            'Thumbimage.dimensions' => 'Featured image must be at least 1900px wide and 1064px tall.',
            'Image.*.dimensions' => 'Slider images must be at least 1900px wide and 1064px tall.'
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
            $destinationDir = public_path('uploads/Reviewsthumb/Image/');
            $thumbImage->move($destinationDir, $thumbImageName);
            $absoluteThumbPath = $destinationDir . $thumbImageName;
            $webpAbsolutePath = $this->generateWebpVariant($absoluteThumbPath);

            if ($webpAbsolutePath && ($relative = $this->relativePublicPath($webpAbsolutePath))) {
                if ($webpAbsolutePath !== $absoluteThumbPath && file_exists($absoluteThumbPath)) {
                    @unlink($absoluteThumbPath);
                }
                $review->ImagePath = $relative;
            } else {
                $review->ImagePath = 'uploads/Reviewsthumb/Image/' . $thumbImageName;
            }
        }
    
        // Save the updated review
        $review->save();
    
        // Handle Slider Images
        if ($request->hasFile('Image')) {
            // Remove old images
            ReviewImage::where('ReviewsID', $review->ReviewsID)->delete();
            
            $order = 0;
            foreach ($request->file('Image') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $destinationDir = public_path('uploads/Reviews/Image/');
                $image->move($destinationDir, $imageName);
                $absoluteImagePath = $destinationDir . $imageName;
                $webpAbsolutePath = $this->generateWebpVariant($absoluteImagePath);
                $relativePath = 'uploads/Reviews/Image/' . $imageName;

                if ($webpAbsolutePath && ($relative = $this->relativePublicPath($webpAbsolutePath))) {
                    if ($webpAbsolutePath !== $absoluteImagePath && file_exists($absoluteImagePath)) {
                        @unlink($absoluteImagePath);
                    }
                    $relativePath = $relative;
                }

                ReviewImage::create([
                    'ReviewsID' => $review->ReviewsID,
                    'ImagePath' => $relativePath,
                    'ImageName' => 'Review Image',
                    'Title' => 'Review Image',
                    'DisplayOrder' => $order++
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

    // Update image order via AJAX
    public function updateImageOrder(Request $request)
    {
        $imageOrder = $request->input('order');
        foreach ($imageOrder as $index => $imageId) {
            ReviewImage::where('ReviewsImageID', $imageId)
                ->update(['DisplayOrder' => $index]);
        }
        return response()->json(['success' => true]);
    }

    // Delete a review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->IsDeleted = 1;
        $review->save();
        return redirect()->route('adminreviews.index')->with('succ_msg', 'Review deleted successfully.');
    }

    protected function relativePublicPath(string $absolutePath): ?string
    {
        $publicPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, public_path());
        $normalizedAbsolute = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $absolutePath);

        if (!str_starts_with($normalizedAbsolute, $publicPath)) {
            return null;
        }

        $relative = ltrim(substr($normalizedAbsolute, strlen($publicPath)), DIRECTORY_SEPARATOR);
        return str_replace(DIRECTORY_SEPARATOR, '/', $relative);
    }

    protected function generateWebpVariant(string $absolutePath, int $quality = 100): ?string
    {
        if (!function_exists('imagewebp') || !file_exists($absolutePath)) {
            Log::warning('WebP conversion skipped: missing imagewebp support or source file.', ['path' => $absolutePath]);
            return null;
        }

        $extension = strtolower(pathinfo($absolutePath, PATHINFO_EXTENSION));
        if ($extension === 'webp') {
            return $absolutePath;
        }

        $webpPath = preg_replace('/\.(jpe?g|png)$/i', '.webp', $absolutePath);
        if (!$webpPath || $webpPath === $absolutePath) {
            return null;
        }

        if (file_exists($webpPath)) {
            return $webpPath;
        }

        $imageInfo = getimagesize($absolutePath);
        if (!$imageInfo) {
            return null;
        }

        $mime = $imageInfo['mime'] ?? '';
        $resource = match ($mime) {
            'image/jpeg' => imagecreatefromjpeg($absolutePath),
            'image/png' => imagecreatefrompng($absolutePath),
            default => null,
        };

        if (!$resource) {
            return null;
        }

        if ($mime === 'image/png') {
            imagepalettetotruecolor($resource);
            imagealphablending($resource, true);
            imagesavealpha($resource, true);
        }

        $result = imagewebp($resource, $webpPath, $quality);
        imagedestroy($resource);

        if (!$result) {
            Log::warning('WebP conversion failed.', ['path' => $absolutePath]);
            return null;
        }

        return $webpPath;
    }
}
