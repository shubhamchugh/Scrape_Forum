<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Backend\Cache\CacheClearController;
use App\Http\Controllers\Backend\Indexing\BingIndexingController;
use App\Http\Controllers\Backend\Indexing\GoogleIndexingController;
use App\Http\Controllers\Backend\Upgrade\UpgradeSoftwareController;

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
    return view('welcome');
});

Route::get('/test', TestController::class);

/***************
 * CACHE CLEAR *
 ***************/
Route::get('clear', CacheClearController::class)->name('clear');

/**********************************************************
 * GET LATEST VERSION OF THE WEBSITE SOFTWARE FROM GITHUB *
 **********************************************************/
Route::get('upgrade', UpgradeSoftwareController::class)->name('upgrade');

/**************************
 * SEARCH ENGINE INDEXING *
 **************************/
Route::get('google-index', [GoogleIndexingController::class, 'google_indexing'])->name('google-index');
Route::get('bing-index', [BingIndexingController::class, 'bing_indexing'])->name('bing-index');
