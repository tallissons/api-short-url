<?php

use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\StatsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/short-urls', [ShortUrlController::class, 'store'])->name('api.short-url.store');
Route::delete('/short-urls/{shortUrl:code}', [ShortUrlController::class, 'destroy'])->name('api.short-url.delete');
Route::get('/short-urls/{shortUrl:code}/stats/last-visit',  [StatsController::class, 'lastVisit'])->name('api.short-url.stats.last-visit');
Route::get('/short-urls/{shortUrl:code}/stats/visit',  [StatsController::class, 'visits'])->name('api.short-url.stats.visits');
