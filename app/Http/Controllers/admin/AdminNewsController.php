<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminNewsController extends Controller
{
    public function index(Request $request)
    {
        // Handle search and page length control
        $search = $request->input('search', '');
        $pageLength = $request->input('pageLength', 10);

        // Query with search filter and sort by PublishDate in descending order
        $query = News::with('category')
            ->where('Name', 'like', "%{$search}%")
            ->where('IsDeleted', 0)
            ->orderBy('PublishDate', 'desc');  // Order by PublishDate DESC

        // Paginate the result with custom page length
        $newsList = $query->paginate($pageLength);

        return view('admin.news.index', compact('newsList', 'search', 'pageLength'));
    }

    /**
     * Show the form for creating a new news item.
     */
    public function create()
    {
        $categories = NewsCategory::where('IsDeleted', 0)->get();

        return view('admin.news.create', compact('categories'));
    }

    /**
     * Store a newly created news item in storage.
     */
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
            'Thumbimage' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3584|dimensions:min_width=1700,min_height=738',
            'Images' => 'nullable|array|max:30',
            'Images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3584|dimensions:min_width=1700,min_height=738',
        ], [
            'Images.max' => 'You can upload up to 30 slider images per news.',
            'Thumbimage.dimensions' => 'Featured image must be at least 1700px wide and 738px tall.',
            'Images.*.dimensions' => 'Slider images must be at least 1400px wide and 800px tall.'
        ]);

        // Create a new instance of the News model
        $news = new News;
        $news->ID = $request->CategoryID; // Set CategoryID as the ID
        $news->MenuID = 2; // MenuID is set to 2 permanently
        $news->Name = $request->Name;
        $news->Code = Str::slug($request->Name);
        $news->Description = $request->description;
        $news->MetaTitle = $request->MetaTitle;
        $news->MetaDescription = $request->MetaDescription;
        $news->Keyword = $request->Keyword;
        $news->Author = $request->Author;
        $news->PublishDate = $request->PublishDate;
        $news->IsActive = $request->IsActive;
        $news->Ip = $request->ip();
        $news->CreatedDateTime = now();
        $news->ModifiedDateTime = now();
        $news->views = 0;

        // Handle Featured Image (Thumbimage) with WebP conversion
        if ($request->hasFile('Thumbimage')) {
            $thumbImage = $request->file('Thumbimage');
            $thumbImageName = time() . '-' . $thumbImage->getClientOriginalName();
            $destinationDir = public_path('uploads/Newsthumb/Image/');
            $thumbImage->move($destinationDir, $thumbImageName);
            $absoluteThumbPath = $destinationDir . $thumbImageName;
            $webpAbsolutePath = $this->generateWebpVariant($absoluteThumbPath);

            if ($webpAbsolutePath && ($relative = $this->relativePublicPath($webpAbsolutePath))) {
                if ($webpAbsolutePath !== $absoluteThumbPath && file_exists($absoluteThumbPath)) {
                    @unlink($absoluteThumbPath);
                }
                $news->ImagePath = $relative;
            } else {
                $news->ImagePath = 'uploads/Newsthumb/Image/' . $thumbImageName;
            }
        }

        // Save the news data
        $news->save();

        // Handle Multiple Images with WebP conversion
        if ($request->hasFile('Images')) {
            $order = 0;
            foreach ($request->file('Images') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $destinationDir = public_path('uploads/News/Image/');
                $image->move($destinationDir, $imageName);
                $absoluteImagePath = $destinationDir . $imageName;
                $webpAbsolutePath = $this->generateWebpVariant($absoluteImagePath);
                $relativePath = 'uploads/News/Image/' . $imageName;

                if ($webpAbsolutePath && ($relative = $this->relativePublicPath($webpAbsolutePath))) {
                    if ($webpAbsolutePath !== $absoluteImagePath && file_exists($absoluteImagePath)) {
                        @unlink($absoluteImagePath);
                    }
                    $relativePath = $relative;
                }

                $newsImage = new NewsImage;
                $newsImage->NewsID = $news->NewsID;
                $newsImage->ImagePath = $relativePath;
                $newsImage->ImageName = 'slider image';
                $newsImage->Title = 'slider image';
                $newsImage->DisplayOrder = $order++;
                $newsImage->save();
            }
        } else {
            Log::info('No additional images uploaded.');
        }

        // **Sitemap Update Logic**
        if ($news->IsActive == 1) {
            Log::info('News is active, updating sitemap...');

            // **Map CategoryID to category name**
            $categoryMap = [
                1 => 'first-drive',
                2 => 'launches',
                3 => 'motorsport',
                4 => 'industry',
                5 => 'others',
            ];
            $category = $categoryMap[$news->ID] ?? 'others'; // Default to 'others' if category not found

            // **Generate URL for the news item**
            $url = "https://www.topgearmag.in/news/$category/" . $news->Code;
            $lastmod = date('Y-m-d', strtotime($news->PublishDate));
            $priority = '0.64';

            // **Prepare the new sitemap entry**
            $sitemapEntry = "
            <url>
                <loc>$url</loc>
                <lastmod>$lastmod</lastmod>
                <priority>$priority</priority>
            </url>";

            // **Path to sitemap file**
            $sitemapPath = public_path('news-sitemap.xml');

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

        // Flash a success message and redirect to the adminnews index page
        Session::flash('succ_msg', 'News post created successfully.');

        return redirect()->route('adminnews.index');
    }

    /**
     * Show the form for editing the specified news item.
     */
    public function edit($id)
    {
        // Ensure you are using the correct relationship
        $news = News::with('images')->findOrFail($id);
        $categories = NewsCategory::where('IsDeleted', 0)->get();

        return view('admin.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified news item in storage.
     */
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
            'Thumbimage' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3584|dimensions:max_width=1700,max_height=738',
            'Images' => 'nullable|array|max:30',
            'Images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3584|dimensions:max_width=1700,max_height=738',
        ], [
            'Images.max' => 'You can upload up to 30 slider images per news.',
            'Thumbimage.dimensions' => 'Featured image must be Max 1700px wide and 738px tall.',
            'Images.*.dimensions' => 'Slider images must be Max 1920px wide and 1080px tall.'
        ]);

        // Retrieve the news post
        $news = News::with('images')->findOrFail($id);

        // Store the previous 'IsActive' and 'Code' (slug) values
        $wasActiveBefore = $news->IsActive;
        $oldSlug = $news->Code;

        // Update the basic news data
        $news->Name = $request->Name;
        $news->MenuID = $request->CategoryID;
        $news->Description = $request->description;
        $news->MetaTitle = $request->MetaTitle;
        $news->MetaDescription = $request->MetaDescription;
        $news->Keyword = $request->Keyword;
        $news->PublishDate = $request->PublishDate;
        $news->IsActive = $request->IsActive;
        $news->ModifiedDateTime = now();

        // Handle slug update logic based on 'IsActive'
        if ($wasActiveBefore == 0) {
            // If the post was inactive, allow slug to be updated
            $news->Code = Str::slug($request->Name);
        }

        // Handle the new featured image (Thumbimage) with WebP conversion
        if ($request->hasFile('Thumbimage')) {
            if ($news->ImagePath && file_exists(public_path($news->ImagePath))) {
                unlink(public_path($news->ImagePath)); // Remove old image
            }
            $thumbImage = $request->file('Thumbimage');
            $thumbImageName = time() . '-' . $thumbImage->getClientOriginalName();
            $destinationDir = public_path('uploads/Newsthumb/Image/');
            $thumbImage->move($destinationDir, $thumbImageName);
            $absoluteThumbPath = $destinationDir . $thumbImageName;
            $webpAbsolutePath = $this->generateWebpVariant($absoluteThumbPath);

            if ($webpAbsolutePath && ($relative = $this->relativePublicPath($webpAbsolutePath))) {
                if ($webpAbsolutePath !== $absoluteThumbPath && file_exists($absoluteThumbPath)) {
                    @unlink($absoluteThumbPath);
                }
                $news->ImagePath = $relative;
            } else {
                $news->ImagePath = 'uploads/Newsthumb/Image/' . $thumbImageName;
            }
        }

        // Save the news data
        $news->save();

        // Handle multiple slider images with WebP conversion
        if ($request->hasFile('Images')) {
            // Get the current max DisplayOrder for this news item
            $maxOrder = NewsImage::where('NewsID', $news->NewsID)->max('DisplayOrder') ?? -1;
            $order = $maxOrder + 1;

            foreach ($request->file('Images') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $destinationDir = public_path('uploads/News/Image/');
                $image->move($destinationDir, $imageName);
                $absoluteImagePath = $destinationDir . $imageName;
                $webpAbsolutePath = $this->generateWebpVariant($absoluteImagePath);
                $relativePath = 'uploads/News/Image/' . $imageName;

                if ($webpAbsolutePath && ($relative = $this->relativePublicPath($webpAbsolutePath))) {
                    if ($webpAbsolutePath !== $absoluteImagePath && file_exists($absoluteImagePath)) {
                        @unlink($absoluteImagePath);
                    }
                    $relativePath = $relative;
                }

                $newsImage = new NewsImage;
                $newsImage->NewsID = $news->NewsID;
                $newsImage->ImagePath = $relativePath;
                $newsImage->ImageName = 'slider image';
                $newsImage->Title = 'slider image';
                $newsImage->DisplayOrder = $order++;
                $newsImage->save();
            }
        }

        // Sitemap logic: Only update sitemap if becoming active now or if slug changes
        if ($wasActiveBefore == 0 && $request->IsActive == 1) {
            // Adding to sitemap if it was inactive before but is now active
            $this->updateSitemap($news);
        } elseif ($wasActiveBefore == 1 && $news->Code != $oldSlug) {
            // If the post was active and the slug is changed, handle sitemap
            $this->handleSlugChangeInSitemap($news, $oldSlug);
        }

        // Flash a success message and redirect
        Session::flash('succ_msg', 'News post updated successfully.');

        return redirect()->route('adminnews.index');
    }

    /**
     * Updates the sitemap for newly activated news
     */
    protected function updateSitemap($news)
    {
        $sitemapPath = public_path('news-sitemap.xml');
        $sitemap = file_get_contents($sitemapPath);

        $categorySlugs = [
            1 => 'first-drive',
            2 => 'launches',
            3 => 'motorsport',
            4 => 'industry',
            5 => 'others',
        ];

        $categorySlug = $categorySlugs[$news->MenuID] ?? 'others';
        $slug = $news->Code;
        $sitemapEntry = "
            <url>
                <loc>https://www.topgearmag.in/news/{$categorySlug}/{$slug}</loc>
                <lastmod>{$news->PublishDate}</lastmod>
                <priority>0.64</priority>
            </url>";

        $sitemap = preg_replace('/(<urlset[^>]*>)/', '$1' . $sitemapEntry, $sitemap);
        file_put_contents($sitemapPath, $sitemap);
    }

    /**
     * Handles old slug removal and updates sitemap for the new slug
     */
    protected function handleSlugChangeInSitemap($news, $oldSlug)
    {
        $sitemapPath = public_path('news-sitemap.xml');
        $sitemap = file_get_contents($sitemapPath);

        $categorySlugs = [
            1 => 'first-drive',
            2 => 'launches',
            3 => 'motorsport',
            4 => 'industry',
            5 => 'others',
        ];

        // Remove the old sitemap entry
        $oldCategorySlug = $categorySlugs[$news->MenuID] ?? 'others';
        $oldSitemapEntry = "<loc>https://www.topgearmag.in/news/{$oldCategorySlug}/{$oldSlug}</loc>";
        $sitemap = str_replace($oldSitemapEntry, '', $sitemap);

        // Add the new sitemap entry
        $this->updateSitemap($news);
    }

    /**
     * Remove the specified news item from storage.
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->IsDeleted = 1;
        $news->save();

        Session::flash('succ_msg', 'News item deleted successfully.');

        return redirect()->route('adminnews.index');
    }

    /**
     * Remove an image via AJAX.
     */
    public function removeImage(Request $request)
    {
        // Get the correct primary key value from the request
        $imageId = $request->input('id');

        // Find the image record using the correct primary key 'NewsImageID'
        $newsImage = NewsImage::where('NewsImageID', $imageId)->firstOrFail();

        // Optionally, you can delete the physical image file from storage
        if (file_exists(public_path($newsImage->ImagePath))) {
            unlink(public_path($newsImage->ImagePath));
        }

        // Delete the image record from the database
        $newsImage->delete();

        // Return a success response
        return response()->json(['success' => true, 'message' => 'Image record removed successfully.']);
    }

    /**
     * Update image order via AJAX.
     */
    public function updateImageOrder(Request $request)
    {
        $imageOrder = $request->input('order');
        foreach ($imageOrder as $index => $imageId) {
            NewsImage::where('NewsImageID', $imageId)
                ->update(['DisplayOrder' => $index]);
        }
        return response()->json(['success' => true]);
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
