<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\DashboardController;
use App\Charts\MonthlyUsersChart;

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
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    
])->prefix('dashboard')->group(function () {

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('/offers', OfferController::class, ['names' => 'offers']);
    Route::get('/offers/{id}/show-image', [OfferController::class, 'showImage'])->name('offers.show-image');
    Route::post('/offers/{id}/delete-image', [OfferController::class, 'deleteImage'])->name('offers.delete-image');
});
