<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Editorial;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
class AdminEditorialController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $pageLength = $request->input('pageLength', 10);

        $query = Editorial::where('Name', 'like', "%{$search}%")
            ->where('IsDeleted', 0)
            ->orderBy('PublishDate', 'desc');

        $editorials = $query->paginate($pageLength);

        return view('admin.editorials.index', compact('editorials', 'search', 'pageLength'));
    }

    public function create()
    {
        return view('admin.editorials.create');
    }


    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'Name' => 'required|string|max:255',
            'description' => 'required|string',
            'MetaTitle' => 'nullable|string|max:60',
            'MetaDescription' => 'nullable|string|max:160',
            'Keyword' => 'nullable|string|max:255',
            'Author' => 'required|string|max:255',
            'PublishDate' => 'required|date',
            'IsActive' => 'required|boolean',
            'Thumbimage' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3584|dimensions:max_width=1920,max_height=1080',
        ], [
            'Thumbimage.dimensions' => 'Featured image must be Max 1920px wide and 1080px tall.'
        ]);

        // Create a new instance of the Editorial model
        $editorial = new Editorial();
        $editorial->Name = $request->Name;
        $editorial->Code = Str::slug($request->Name);
        $editorial->Description = $request->description;
        $editorial->MetaTitle = $request->MetaTitle;
        $editorial->MetaDescription = $request->MetaDescription;
        $editorial->Keyword = $request->Keyword;
        $editorial->Author = $request->Author;
        $editorial->PublishDate = $request->PublishDate;
        $editorial->IsActive = $request->IsActive;
        $editorial->views = 0;
        $editorial->Ip = $request->ip(); // Add the IP

        // Handle Featured Image (Thumbimage)
        if ($request->hasFile('Thumbimage')) {
            $thumbImage = $request->file('Thumbimage');
            $thumbImageName = time() . '-' . $thumbImage->getClientOriginalName();
            $destinationDir = public_path('uploads/Editorial/Image/');

            if (!file_exists($destinationDir)) {
                mkdir($destinationDir, 0755, true);
            }

            $thumbImage->move($destinationDir, $thumbImageName);
            $absolutePath = $destinationDir . $thumbImageName;

            // Generate WebP variant
            $webpAbsolutePath = $this->generateWebpVariant($absolutePath);
            $relativePath = 'uploads/Editorial/Image/' . $thumbImageName;

            if ($webpAbsolutePath && ($relative = $this->relativePublicPath($webpAbsolutePath))) {
                // If WebP was generated and path is resolved, use it
                if ($webpAbsolutePath !== $absolutePath && file_exists($absolutePath)) {
                    @unlink($absolutePath); // Remove original
                }
                $relativePath = $relative;
            }

            $editorial->ImagePath = $relativePath;
        }

        $editorial->CreatedDateTime = now();
        $editorial->ModifiedDateTime = now();
        // Save the editorial first to get the EditorialID
        $editorial->save();

        // **Sitemap Update Logic**
        if ($editorial->IsActive == 1) {
            Log::info('Editorial is active, updating sitemap...');

            // **Generate URL for the editorial item**
            $url = "https://www.topgearmag.in/editorial/" . $editorial->Code;
            $lastmod = date('Y-m-d', strtotime($editorial->PublishDate));
            $priority = '0.64';

            // **Prepare the new sitemap entry**
            $sitemapEntry = "
            <url>
                <loc>$url</loc>
                <lastmod>$lastmod</lastmod>
                <priority>$priority</priority>
            </url>";

            // **Path to sitemap file**
            $sitemapPath = public_path('editorial-sitemap.xml');

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
        Session::flash('succ_msg', 'Editorial created successfully.');

        return redirect()->route('admineditorials.index');
    }



    public function edit($id)
    {
        $editorial = Editorial::findOrFail($id);
        return view('admin.editorials.edit', compact('editorial'));
    }


    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'Name' => 'required|string|max:255',
            'description' => 'required|string',
            'MetaTitle' => 'nullable|string|max:60',
            'MetaDescription' => 'nullable|string|max:160',
            'Keyword' => 'nullable|string|max:255',
            'PublishDate' => 'required|date',
            'IsActive' => 'required|boolean',
            'Thumbimage' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3584|dimensions:max_width=1920,max_height=1080',
        ], [
            'Thumbimage.dimensions' => 'Featured image must be Max 1920px wide and 1080px tall.'
        ]);

        // Retrieve the editorial post
        $editorial = Editorial::findOrFail($id);

        // Store the previous 'IsActive' and 'Code' (slug) values
        $wasActiveBefore = $editorial->IsActive;
        $oldSlug = $editorial->Code;

        // Update the basic editorial data
        $editorial->Name = $request->Name;
        $editorial->Description = $request->description;
        $editorial->MetaTitle = $request->MetaTitle;
        $editorial->MetaDescription = $request->MetaDescription;
        $editorial->Keyword = $request->Keyword;
        $editorial->PublishDate = $request->PublishDate;
        $editorial->IsActive = $request->IsActive;
        $editorial->ModifiedDateTime = now();

        // Handle slug update logic based on 'IsActive'
        if ($wasActiveBefore == 0) {
            // If the post was inactive, allow slug to be updated
            $editorial->Code = Str::slug($request->Name);
        }

        // Handle the new featured image (Thumbimage)
        if ($request->hasFile('Thumbimage')) {
            if ($editorial->ImagePath && file_exists(public_path($editorial->ImagePath))) {
                unlink(public_path($editorial->ImagePath)); // Remove old image
            }
            $thumbImage = $request->file('Thumbimage');
            $thumbImageName = time() . '-' . $thumbImage->getClientOriginalName();
            $destinationDir = public_path('uploads/Editorial/Image/');

            if (!file_exists($destinationDir)) {
                mkdir($destinationDir, 0755, true);
            }

            $thumbImage->move($destinationDir, $thumbImageName);
            $absolutePath = $destinationDir . $thumbImageName;

            // Generate WebP variant
            $webpAbsolutePath = $this->generateWebpVariant($absolutePath);
            $relativePath = 'uploads/Editorial/Image/' . $thumbImageName;

            if ($webpAbsolutePath && ($relative = $this->relativePublicPath($webpAbsolutePath))) {
                // If WebP was generated and path is resolved, use it
                if ($webpAbsolutePath !== $absolutePath && file_exists($absolutePath)) {
                    @unlink($absolutePath); // Remove original
                }
                $relativePath = $relative;
            }

            $editorial->ImagePath = $relativePath;
        }

        // Save the editorial data
        $editorial->save();

        // Sitemap logic: Only update sitemap if becoming active now or if slug changes
        if ($wasActiveBefore == 0 && $request->IsActive == 1) {
            // Adding to sitemap if it was inactive before but is now active
            $this->updateEditorialSitemap($editorial);
        } elseif ($wasActiveBefore == 1 && $editorial->Code != $oldSlug) {
            // If the post was active and the slug is changed, handle sitemap
            $this->handleSlugChangeInEditorialSitemap($editorial, $oldSlug);
        }

        // Flash a success message and redirect
        Session::flash('succ_msg', 'Editorial updated successfully.');

        return redirect()->route('admineditorials.index');
    }

    /**
     * Updates the sitemap for newly activated editorial
     */
    protected function updateEditorialSitemap($editorial)
    {
        $sitemapPath = public_path('editorial-sitemap.xml');
        $sitemap = file_get_contents($sitemapPath);

        $slug = $editorial->Code;
        $sitemapEntry = "
            <url>
                <loc>https://www.topgearmag.in/editorials/{$slug}</loc>
                <lastmod>{$editorial->PublishDate}</lastmod>
                <priority>0.64</priority>
            </url>";

        $sitemap = preg_replace('/(<urlset[^>]*>)/', '$1' . $sitemapEntry, $sitemap);
        file_put_contents($sitemapPath, $sitemap);
    }

    /**
     * Handles old slug removal and updates sitemap for the new slug
     */
    protected function handleSlugChangeInEditorialSitemap($editorial, $oldSlug)
    {
        $sitemapPath = public_path('editorial-sitemap.xml');
        $sitemap = file_get_contents($sitemapPath);

        // Remove the old sitemap entry
        $oldSitemapEntry = "<loc>https://www.topgearmag.in/editorials/{$oldSlug}</loc>";
        $sitemap = str_replace($oldSitemapEntry, '', $sitemap);

        // Add the new sitemap entry
        $this->updateEditorialSitemap($editorial);
    }



    public function destroy($id)
    {
        $editorial = Editorial::findOrFail($id);
        $editorial->IsDeleted = 1;
        $editorial->save();
        Session::flash('succ_msg', 'Editorial deleted successfully.');
        return redirect()->route('admineditorials.index');
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
