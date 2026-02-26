<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/portfolio', [PortfolioController::class, 'index']);

Route::get('/get-a-quote', [QuoteController::class, 'show']);
Route::post('/get-a-quote', [QuoteController::class, 'submit']);

Route::get('/contact', [PageController::class, 'contact']);

Route::prefix('services')->group(function (): void {
    Route::get('/weddings', [PageController::class, 'weddings']);
    Route::get('/music-videos', [PageController::class, 'musicVideos']);
    Route::get('/corporate', [PageController::class, 'corporate']);
    Route::get('/content-for-business', [PageController::class, 'contentForBusiness']);
    Route::get('/vox-pops', [PageController::class, 'voxPops']);
    Route::get('/events', [PageController::class, 'events']);
});
