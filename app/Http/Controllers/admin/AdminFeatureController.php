<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\FeatureCategory;
use App\Models\FeatureImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminFeatureController extends Controller
{
    public function index(Request $request)
    {
        // Handle search and page length control
        $search = $request->input('search', '');
        $pageLength = $request->input('pageLength', 10);

        // Query with search filter and sort by PublishDate in descending order
        $query = Feature::with('category')
            ->where('Name', 'like', "%{$search}%")
            ->where('IsDeleted', 0)
            ->orderBy('PublishDate', 'desc');  // Order by PublishDate DESC

        // Paginate the result with custom page length
        $features = $query->paginate($pageLength);

        return view('admin.features.index', compact('features', 'search', 'pageLength'));
    }

    // Show the create form
    public function create()
    {
        // Get the Feature categories
        $categories = FeatureCategory::where('IsDeleted', 0)->get();

        return view('admin.features.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'Name' => 'required|string|max:255',
            'CategoryID' => 'required|integer',
            'description' => 'required|string',
            'MetaTitle' => 'nullable|string|max:60',
            'MetaDescription' => 'nullable|string|max:160',
            'Keyword' => 'nullable|string|max:255',
            'Author' => 'required|string|max:255',
            'PublishDate' => 'required|date',
            'IsActive' => 'required|boolean',
            'Thumbimage' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'Images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:9096',
        ]);

        // Create a new instance of the Feature model
        $feature = new Feature;
        $feature->ID = $request->CategoryID; // Foreign key for category
        $feature->MenuID = 3; // Fixed MenuID
        $feature->Name = $request->Name;
        $feature->Code = Str::slug($request->Name);
        $feature->Description = $request->description;
        $feature->MetaTitle = $request->MetaTitle;
        $feature->MetaDescription = $request->MetaDescription;
        $feature->Keyword = $request->Keyword;
        $feature->Author = $request->Author;
        $feature->PublishDate = $request->PublishDate;
        $feature->IsActive = $request->IsActive;
        $feature->Ip = $request->ip();
        $feature->CreatedDateTime = now();
        $feature->ModifiedDateTime = now();
        $feature->views = 0;

        // Handle Featured Image (Thumbimage)
        if ($request->hasFile('Thumbimage')) {
            $thumbImage = $request->file('Thumbimage');
            $thumbImageName = time().'-'.$thumbImage->getClientOriginalName();
            $thumbImagePath = $thumbImage->move(public_path('uploads/Featuresthumb/Image/'), $thumbImageName);
            $feature->ImagePath = 'uploads/Featuresthumb/Image/'.$thumbImageName;
        }

        // Save the feature first to get the FeatureID
        $feature->save();

        // Handle Multiple Images
        if ($request->hasFile('Images')) {
            foreach ($request->file('Images') as $image) {
                $imageName = time().'-'.$image->getClientOriginalName();
                $imagePath = $image->move(public_path('uploads/Features/Image/'), $imageName); // Updated path

                // Create new FeaturesImage records and associate them with the feature
                $featureImage = new FeatureImage;
                $featureImage->FeatureID = $feature->FeatureID;  // Set the correct FeatureID
                $featureImage->ImagePath = 'uploads/Features/Image/'.$imageName;
                $featureImage->ImageName = 'slider image';
                $featureImage->Title = 'slider image';
                $featureImage->CreatedDateTime = now();
                $featureImage->save();
            }
        }

        // **Sitemap Update Logic**
        if ($feature->IsActive == 1) {
            Log::info('Feature is active, updating sitemap...');

            // **Map CategoryID to category name**
            $categoryMap = [
                1 => 'tg-explains',
                2 => 'blogs',
                3 => 'travelogues',
                4 => 'interviews',
                5 => 'special-features',
                // Add more categories as needed
            ];
            $category = $categoryMap[$feature->ID] ?? 'others'; // Default to 'others' if category not found

            // **Generate URL for the feature item**
            $url = "https://www.topgearmag.in//features/$category/".$feature->Code;
            $lastmod = date('Y-m-d', strtotime($feature->PublishDate));
            $priority = '0.64';

            // **Prepare the new sitemap entry**
            $sitemapEntry = "
        <url>
            <loc>$url</loc>
            <lastmod>$lastmod</lastmod>
            <priority>$priority</priority>
        </url>";

            // **Path to sitemap file**
            $sitemapPath = public_path('features-sitemap.xml');

            // **Check if the file exists and prepend the new entry**
            if (file_exists($sitemapPath)) {
                // Load the existing sitemap content
                $sitemapContent = file_get_contents($sitemapPath);

                // Insert the new entry after the opening <urlset> tag
                $sitemapContent = preg_replace(
                    '/(<urlset[^>]*>)/',
                    "$1\n$sitemapEntry",
                    $sitemapContent
                );

                // Save the updated sitemap back to the file
                file_put_contents($sitemapPath, $sitemapContent);

                Log::info('Sitemap updated successfully with new entry: '.$url);
            } else {
                Log::error('Sitemap file not found at: '.$sitemapPath);
            }
        }

        // Flash success message and redirect
        Session::flash('succ_msg', 'Feature created successfully.');

        return redirect()->route('adminfeatures.index');
    }

    // Show the edit form for a specific feature
    public function edit($id)
    {
        $feature = Feature::with('images')->findOrFail($id);
        $categories = FeatureCategory::all();

        return view('admin.features.edit', compact('feature', 'categories'));
    }

    // Update the specified feature in the database
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'Name' => 'required|string|max:255',
            'CategoryID' => 'required|integer',
            'description' => 'required|string',
            'MetaTitle' => 'nullable|string|max:60',
            'MetaDescription' => 'nullable|string|max:160',
            'Keyword' => 'nullable|string|max:255',
            'PublishDate' => 'required|date',
            'IsActive' => 'required|boolean',
            'Thumbimage' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'Images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:9096',
        ]);

        // Retrieve the feature post
        $feature = Feature::with('images')->findOrFail($id);

        // Store the previous 'IsActive' and 'Code' (slug) values
        $wasActiveBefore = $feature->IsActive;
        $oldSlug = $feature->Code;

        // Update the basic feature data
        $feature->Name = $request->Name;
        $feature->ID = $request->CategoryID; // Category ID
        $feature->Description = $request->description;
        $feature->MetaTitle = $request->MetaTitle;
        $feature->MetaDescription = $request->MetaDescription;
        $feature->Keyword = $request->Keyword;
        $feature->PublishDate = $request->PublishDate;
        $feature->IsActive = $request->IsActive;
        $feature->ModifiedDateTime = now();

        // Handle slug update logic based on 'IsActive'
        if ($wasActiveBefore == 0) {
            // If the post was inactive, allow slug to be updated
            $feature->Code = Str::slug($request->Name);
        }

        // Handle the new featured image (Thumbimage)
        if ($request->hasFile('Thumbimage')) {
            if ($feature->ImagePath && file_exists(public_path($feature->ImagePath))) {
                unlink(public_path($feature->ImagePath)); // Remove old image
            }
            $thumbImage = $request->file('Thumbimage');
            $thumbImageName = time().'-'.$thumbImage->getClientOriginalName();
            $thumbImagePath = $thumbImage->move(public_path('uploads/Featuresthumb/Image'), $thumbImageName);
            $feature->ImagePath = 'uploads/Featuresthumb/Image/'.$thumbImageName;
        }

        // Save the feature data
        $feature->save();

        // Handle multiple slider images
        if ($request->hasFile('Images')) {
            foreach ($request->file('Images') as $image) {
                $imageName = time().'-'.$image->getClientOriginalName();
                $imagePath = $image->move(public_path('uploads/Features/Image'), $imageName);

                $featureImage = new FeatureImage;
                $featureImage->FeatureID = $feature->FeatureID;
                $featureImage->ImagePath = 'uploads/Features/Image/'.$imageName;
                $featureImage->ImageName = 'slider image';
                $featureImage->Title = 'slider image';
                $featureImage->CreatedDateTime = now();
                $featureImage->save();
            }
        }

        // Sitemap logic: Only update sitemap if becoming active now or if slug changes
        if ($wasActiveBefore == 0 && $request->IsActive == 1) {
            // Adding to sitemap if it was inactive before but is now active
            $this->updateFeatureSitemap($feature);
        } elseif ($wasActiveBefore == 1 && $feature->Code != $oldSlug) {
            // If the post was active and the slug is changed, handle sitemap
            $this->handleSlugChangeInFeatureSitemap($feature, $oldSlug);
        }

        // Flash a success message and redirect
        Session::flash('succ_msg', 'Feature updated successfully.');

        return redirect()->route('adminfeatures.index');
    }

    /**
     * Updates the sitemap for newly activated feature
     */
    protected function updateFeatureSitemap($feature)
    {
        $sitemapPath = public_path('features-sitemap.xml');
        $sitemap = file_get_contents($sitemapPath);

        $categorySlugs = [
            1 => 'tg-explains',
            2 => 'blogs',
            3 => 'travelogues',
            4 => 'interviews',
            5 => 'special-features',
            // Add more categories as needed
        ];

        $categorySlug = $categorySlugs[$feature->ID] ?? 'others';
        $slug = $feature->Code;
        $sitemapEntry = "
            <url>
                <loc>https://www.topgearmag.in/features/{$categorySlug}/{$slug}</loc>
                <lastmod>{$feature->PublishDate}</lastmod>
                <priority>0.64</priority>
            </url>";

        $sitemap = preg_replace('/(<urlset[^>]*>)/', '$1'.$sitemapEntry, $sitemap);
        file_put_contents($sitemapPath, $sitemap);
    }

    /**
     * Handles old slug removal and updates sitemap for the new slug
     */
    protected function handleSlugChangeInFeatureSitemap($feature, $oldSlug)
    {
        $sitemapPath = public_path('features-sitemap.xml');
        $sitemap = file_get_contents($sitemapPath);

        $categorySlugs = [
            1 => 'tg-explains',
            2 => 'blogs',
            3 => 'travelogues',
            4 => 'interviews',
            5 => 'special-features',
        ];

        // Remove the old sitemap entry
        $oldCategorySlug = $categorySlugs[$feature->ID] ?? 'others';
        $oldSitemapEntry = "<loc>https://www.topgearmag.in/features/{$oldCategorySlug}/{$oldSlug}</loc>";
        $sitemap = str_replace($oldSitemapEntry, '', $sitemap);

        // Add the new sitemap entry
        $this->updateFeatureSitemap($feature);
    }

    // Delete a specific feature from the database
    public function destroy($id)
    {
        $feature = Feature::findOrFail($id);
        $feature->IsDeleted = 1;
        $feature->save();
        Session::flash('succ_msg', 'Feature deleted successfully.');

        return redirect()->route('adminfeatures.index');
    }

    // Remove a specific feature image via AJAX
    public function removeImage(Request $request)
    {
        $imageId = $request->input('id');
        $featureImage = FeatureImage::findOrFail($imageId);

        // Delete image file
        if ($featureImage->ImagePath && file_exists(public_path($featureImage->ImagePath))) {
            unlink(public_path($featureImage->ImagePath));
        }

        // Delete image record from database
        $featureImage->delete();

        return response()->json(['success' => true, 'message' => 'Image removed successfully.']);
    }
}
