<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\DashboardController;
use App\Charts\MonthlyUsersChart;
use Inertia\Inertia;
use App\Models\Offer;
use App\Http\Controllers\OfferFrontController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'offers' => Offer::with('images')->paginate(10),
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    
])->prefix('dashboard')->group(function () {

    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::post('/dashboard/prefrences/items-per-page-history', [DashboardController::class, 'prefrencesItemsPerPageHistory'])->name('dashboard.prefrences.items-per-page-history');

    Route::resource('/offers', OfferController::class, ['names' => 'offers']);
    Route::get('/offers/{id}/show-image', [OfferController::class, 'showImage'])->name('offers.show-image');
    Route::post('/offers/{id}/delete-image', [OfferController::class, 'deleteImage'])->name('offers.delete-image');

    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::post('/comments/change-view-mode', [CommentController::class, 'changeViewMode'])->name('comments.change-view-mode');
    Route::get('/comments/search-by-offer/{offer_id}', [CommentController::class, 'showByOffer'])->name('comments.show-by-offer');

});

Route::get('/offers/{id}', [OfferFrontController::class, 'show'])->name('offers.front.show');
Route::get('/offers', [OfferFrontController::class, 'index'])->name('offers.front.index');
Route::post('/offers/{id}/place-comment', [OfferFrontController::class, 'placeComment'])->name('offers.front.place-comment');
Route::post('/offers/{id}/mark-as-helpful', [OfferFrontController::class, 'markAsHelpful'])->name('offers.front.mark-as-helpful');
Route::delete('/offers/{id}/delete-comment', [OfferFrontController::class, 'deleteComment'])->name('offers.front.delete-comment');
Route::get('/offers/{offer_id}/report-comment/{comment_id}', [OfferFrontController::class, 'reportComment'])->name('offers.front.report-comment');
Route::post('/offers/{offer_id}/report-comment/{comment_id}', [OfferFrontController::class, 'submitReportComment'])->name('offers.front.submtit-report-comment');
