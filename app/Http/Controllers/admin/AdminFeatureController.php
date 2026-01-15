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
            'Thumbimage' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3584|dimensions:min_width=1700,min_height=950',
            'Images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3584|dimensions:min_width=1400,min_height=800',
        ], [
            'Images.max' => 'You can upload up to 30 slider images per feature.',
            'Thumbimage.dimensions' => 'Featured image must be at least 1700px wide and 950px tall.',
            'Images.*.dimensions' => 'Slider images must be at least 1400px wide and 800px tall.'
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
            $thumbImageName = time() . '-' . $thumbImage->getClientOriginalName();
            $destinationDir = public_path('uploads/Featuresthumb/Image/');

            if (!file_exists($destinationDir)) {
                mkdir($destinationDir, 0755, true);
            }

            $thumbImage->move($destinationDir, $thumbImageName);
            $absolutePath = $destinationDir . $thumbImageName;

            // Generate WebP variant
            $webpAbsolutePath = $this->generateWebpVariant($absolutePath);
            $relativePath = 'uploads/Featuresthumb/Image/' . $thumbImageName;

            if ($webpAbsolutePath && ($relative = $this->relativePublicPath($webpAbsolutePath))) {
                // If WebP was generated and path is resolved, use it
                if ($webpAbsolutePath !== $absolutePath && file_exists($absolutePath)) {
                    @unlink($absolutePath); // Remove original
                }
                $relativePath = $relative;
            }

            $feature->ImagePath = $relativePath;
        }

        // Save the feature first to get the FeatureID
        $feature->save();

        // Handle Multiple Images
        if ($request->hasFile('Images')) {
            Log::info('Feature Store: Images found in request.');
            $order = 0;
            foreach ($request->file('Images') as $image) {
                try {
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $destinationPath = public_path('uploads/Features/Image/');

                    // Create directory if it doesn't exist
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    $image->move($destinationPath, $imageName);
                    $absolutePath = $destinationPath . $imageName;

                    // Generate WebP variant
                    $webpAbsolutePath = $this->generateWebpVariant($absolutePath);
                    $relativePath = 'uploads/Features/Image/' . $imageName;

                    if ($webpAbsolutePath && ($relative = $this->relativePublicPath($webpAbsolutePath))) {
                        // If WebP was generated and path is resolved, use it
                        if ($webpAbsolutePath !== $absolutePath && file_exists($absolutePath)) {
                            @unlink($absolutePath); // Remove original
                        }
                        $relativePath = $relative;
                    }

                    // Create new FeaturesImage records and associate them with the feature
                    $featureImage = new FeatureImage;
                    $featureImage->FeatureID = $feature->FeatureID;
                    $featureImage->ImagePath = $relativePath;
                    $featureImage->ImageName = 'slider image';
                    $featureImage->Title = 'slider image';
                    $featureImage->CreatedDateTime = now();
                    $featureImage->DisplayOrder = $order++;
                    $featureImage->save();

                    Log::info('Feature Store: Image saved successfully: ' . $relativePath);
                } catch (\Exception $e) {
                    Log::error('Feature Store: Error saving image: ' . $e->getMessage());
                }
            }
        } else {
            Log::info('Feature Store: No images found in request.');
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
            $url = "https://www.topgearmag.in//features/$category/" . $feature->Code;
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

                Log::info('Sitemap updated successfully with new entry: ' . $url);
            } else {
                Log::error('Sitemap file not found at: ' . $sitemapPath);
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
            'Thumbimage' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3584|dimensions:min_width=1700,min_height=950|dimensions:max_width=1920,max_height=1080',
            'Images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3584|dimensions:min_width=1400,min_height=800| dimensions:max_width=1920,max_height=1080',
        ], [
            'Images.max' => 'You can upload up to 30 slider images per feature.',
            'Thumbimage.dimensions' => 'The featured image must be at least 1700px wide and 950px tall, and at most 1920px wide and 1080px tall.',
            'Images.*.dimensions' => 'Slider images must be at least 1400px wide and 800px tall, and at most 1920px wide and 1080px tall.'
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
                @unlink(public_path($feature->ImagePath)); // Remove old image
            }
            $thumbImage = $request->file('Thumbimage');
            $thumbImageName = time() . '-' . $thumbImage->getClientOriginalName();
            $destinationDir = public_path('uploads/Featuresthumb/Image/');

            if (!file_exists($destinationDir)) {
                mkdir($destinationDir, 0755, true);
            }

            $thumbImage->move($destinationDir, $thumbImageName);
            $absolutePath = $destinationDir . $thumbImageName;

            // Generate WebP variant
            $webpAbsolutePath = $this->generateWebpVariant($absolutePath);
            $relativePath = 'uploads/Featuresthumb/Image/' . $thumbImageName;

            if ($webpAbsolutePath && ($relative = $this->relativePublicPath($webpAbsolutePath))) {
                // If WebP was generated and path is resolved, use it
                if ($webpAbsolutePath !== $absolutePath && file_exists($absolutePath)) {
                    @unlink($absolutePath); // Remove original
                }
                $relativePath = $relative;
            }

            $feature->ImagePath = $relativePath;
        }

        // Save the feature data
        $feature->save();

        // Handle multiple slider images
        if ($request->hasFile('Images')) {
            Log::info('Feature Update: Images found in request.');
            // Get the current max display order
            $maxOrder = FeatureImage::where('FeatureID', $feature->FeatureID)->max('DisplayOrder') ?? 0;
            $order = $maxOrder + 1;

            foreach ($request->file('Images') as $image) {
                try {
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $destinationPath = public_path('uploads/Features/Image/');

                    // Create directory if it doesn't exist
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    $image->move($destinationPath, $imageName);
                    $absolutePath = $destinationPath . $imageName;

                    // Generate WebP variant
                    $webpAbsolutePath = $this->generateWebpVariant($absolutePath);
                    $relativePath = 'uploads/Features/Image/' . $imageName;

                    if ($webpAbsolutePath && ($relative = $this->relativePublicPath($webpAbsolutePath))) {
                        // If WebP was generated and path is resolved, use it
                        if ($webpAbsolutePath !== $absolutePath && file_exists($absolutePath)) {
                            @unlink($absolutePath); // Remove original
                        }
                        $relativePath = $relative;
                    }

                    $featureImage = new FeatureImage;
                    $featureImage->FeatureID = $feature->FeatureID;
                    $featureImage->ImagePath = $relativePath;
                    $featureImage->ImageName = 'slider image';
                    $featureImage->Title = 'slider image';
                    $featureImage->CreatedDateTime = now();
                    $featureImage->DisplayOrder = $order++;
                    $featureImage->save();

                    Log::info('Feature Update: Image saved successfully: ' . $relativePath);
                } catch (\Exception $e) {
                    Log::error('Feature Update: Error saving image: ' . $e->getMessage());
                }
            }
        } else {
            Log::info('Feature Update: No additional images uploaded.');
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

        $sitemap = preg_replace('/(<urlset[^>]*>)/', '$1' . $sitemapEntry, $sitemap);
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

    /**
     * Update image order via AJAX.
     */
    public function updateImageOrder(Request $request)
    {
        $imageOrder = $request->input('order');
        foreach ($imageOrder as $index => $imageId) {
            FeatureImage::where('FeaturesImageID', $imageId)
                ->update(['DisplayOrder' => $index]);
        }
        return response()->json(['success' => true]);
    }

    protected function relativePublicPath(string $absolutePath): ?string
    {
        $publicPath = rtrim(public_path(), DIRECTORY_SEPARATOR);
        $normalizedAbsolute = rtrim($absolutePath, DIRECTORY_SEPARATOR);

        if (!str_starts_with($normalizedAbsolute, $publicPath)) {
            return null;
        }

        $relative = ltrim(substr($normalizedAbsolute, strlen($publicPath)), DIRECTORY_SEPARATOR);
        return str_replace(DIRECTORY_SEPARATOR, '/', $relative);
    }

    protected function generateWebpVariant(string $absolutePath, int $quality = 70): ?string
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
