<?php

use App\Http\Controllers\admin\AdminFeatureController;
use App\Http\Controllers\admin\AdminNewsController;
use App\Http\Controllers\admin\AdminEditorialController;
use App\Http\Controllers\admin\AdminReviewController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\ElectricController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\PollResultsController;
//use App\Http\Controllers\ImpressionController; //Turtle Wax Ad cretive Impression

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('features/{category}', [FeatureController::class, 'category']);
Route::get('features/{category}/{code}', [FeatureController::class, 'details']);

Route::get('electric', [ElectricController::class, 'list'])->name('electric.list');
Route::get('electric/{code}', [ElectricController::class, 'details'])->name('electric.details');

Route::get('/editorial', [EditorialController::class, 'list'])->name('editorial.list');
Route::get('/editorial/{code}', [EditorialController::class, 'details'])->name('editorial.details');

Route::get('/awards', [StaticPageController::class, 'awards'])->name('awards');

Route::get('/winners23', [StaticPageController::class, 'winners23'])->name('winners23');
Route::get('/winners24', [StaticPageController::class, 'winners24'])->name('winners24');
Route::get('/winners25', [StaticPageController::class, 'winners25'])->name('winners25');

//Route::get('/tg-score', [PollResultsController::class, 'showResults'])->name('poll.results');

//Turtle Wax Ad cretive Impression
//Route::post('/track-impression', [ImpressionController::class, 'store'])->name('track.impression');

//Route::get('/signup', [VotingController::class, 'showSignup'])->name('signup');
//Route::post('/signup', [VotingController::class, 'storeUser'])->name('signup.store');

// Route::get('/tgcars', [VotingController::class, 'showVoting'])->name('awards.voting');
// Route::post('/tgcars', [VotingController::class, 'storeCarVotes'])->name('awards.voting.store');

//Route::get('/bikes', [VotingController::class, 'showBikes'])->name('awards.bikes');
//Route::post('/bikes', [VotingController::class, 'storeBikeVotes'])->name('awards.bikes.store');

Route::get('/carsvote', [VotingController::class, 'showVoting'])->name('awards.voting26');
//Route::post('/carsvote', [VotingController::class, 'storeCarVotes'])->name('awards.voting.store');

Route::get('/contact-us', [StaticPageController::class, 'contact'])->name('contact');
Route::get('/about-us', [StaticPageController::class, 'about'])->name('about');
Route::get('/career', [StaticPageController::class, 'career'])->name('career');
Route::get('/terms-conditions', [StaticPageController::class, 'terms'])->name('terms-conditions');

Route::get('reviews/{menu}', [ReviewController::class, 'menu']);
Route::get('reviews/{menu}/{category}', [ReviewController::class, 'category']);
Route::get('reviews/{menu}/{category}/{code}', [ReviewController::class, 'details']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('adminnews')->group(function () {
        Route::get('/', [AdminNewsController::class, 'index'])->name('adminnews.index');
        Route::get('/create', [AdminNewsController::class, 'create'])->name('adminnews.create');
        Route::post('/', [AdminNewsController::class, 'store'])->name('adminnews.store');
        Route::get('/{id}/edit', [AdminNewsController::class, 'edit'])->name('adminnews.edit');
        Route::put('/{id}', [AdminNewsController::class, 'update'])->name('adminnews.update');
        Route::delete('/{id}', [AdminNewsController::class, 'destroy'])->name('adminnews.destroy');
        // Route to remove an image via AJAX
        Route::post('/adminnews/remove-image', [AdminNewsController::class, 'removeImage'])->name('adminnews.removeImage');
    });

    Route::prefix('adminfeatures')->group(function () {
        Route::get('/', [AdminFeatureController::class, 'index'])->name('adminfeatures.index');
        Route::get('/create', [AdminFeatureController::class, 'create'])->name('adminfeatures.create');
        Route::post('/', [AdminFeatureController::class, 'store'])->name('adminfeatures.store');
        Route::get('/{id}/edit', [AdminFeatureController::class, 'edit'])->name('adminfeatures.edit');
        Route::put('/{id}', [AdminFeatureController::class, 'update'])->name('adminfeatures.update');
        Route::delete('/{id}', [AdminFeatureController::class, 'destroy'])->name('adminfeatures.destroy');
        // Route to remove an image via AJAX
        Route::post('/remove-image', [AdminFeatureController::class, 'removeImage'])->name('adminfeatures.removeImage');
    });

    Route::prefix('admineditorials')->group(function () {
        Route::get('/', [AdminEditorialController::class, 'index'])->name('admineditorials.index');
        Route::get('/create', [AdminEditorialController::class, 'create'])->name('admineditorials.create');
        Route::post('/', [AdminEditorialController::class, 'store'])->name('admineditorials.store');
        Route::get('/{id}/edit', [AdminEditorialController::class, 'edit'])->name('admineditorials.edit');
        Route::put('/{id}', [AdminEditorialController::class, 'update'])->name('admineditorials.update');
        Route::delete('/{id}', [AdminEditorialController::class, 'destroy'])->name('admineditorials.destroy');
    });

    Route::prefix('adminreviews')->group(function () {
        Route::get('/', [AdminReviewController::class, 'index'])->name('adminreviews.index');
        Route::get('/create', [AdminReviewController::class, 'create'])->name('adminreviews.create');
        Route::post('/', [AdminReviewController::class, 'store'])->name('adminreviews.store');
        // Routes in web.php
        Route::post('/fetch-category', [AdminReviewController::class, 'fetchCategory'])->name('adminreviews.fetch-category');
        Route::post('/fetch-tabs', [AdminReviewController::class, 'fetchTabsByMenuID'])->name('adminreviews.fetch-tabs');

        Route::get('/{id}/edit', [AdminReviewController::class, 'edit'])->name('adminreviews.edit');
        Route::put('/{id}', [AdminReviewController::class, 'update'])->name('adminreviews.update');
        Route::delete('/{id}', [AdminReviewController::class, 'destroy'])->name('adminreviews.destroy');
        Route::post('/update-image-order', [AdminReviewController::class, 'updateImageOrder'])->name('adminreviews.updateImageOrder');
    });

});

Route::get('news/{category}/{code}', [NewsController::class, 'details'])->name('news.details');
Route::get('news/{category}', [NewsController::class, 'category'])->name('news.category');

Route::get('search', [SearchController::class, 'index'])->name('search.index');
Route::get('/author/{author}', [AuthorController::class, 'show'])->name('author.show');

//Redirect to external links
Route::get('/magazine', function () {
    return redirect()->away('https://exhibitstore.in');
});

Route::get('/awards2026', function () {
    return redirect()->away('https://docs.google.com/forms/d/e/1FAIpQLSfOtGLJQAwViD-mxlnypf0E4Xd2V8D3wolMsUx9uBS6vExgMg/viewform');
});
Route::get('/signup', function () {
    return redirect()->away('http://www.topgearmag.in/awards');
});
Route::get('/rsvp', function () {
    return redirect()->away('https://docs.google.com/forms/d/e/1FAIpQLSeFi5LAJDBavK4SXAaOGn7LhBad6gkTL0jto2EbEfo8YTHfbg/viewform?usp=header');
});

require __DIR__.'/auth.php';
