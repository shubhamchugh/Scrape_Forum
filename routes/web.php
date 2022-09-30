<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Backend\Cache\CacheClearController;
use App\Http\Controllers\Backend\Transfer\StackToNovaController;
use App\Http\Controllers\Backend\Indexing\BingIndexingController;
use App\Http\Controllers\Backend\Indexing\GoogleIndexingController;
use App\Http\Controllers\Backend\Upgrade\UpgradeSoftwareController;
use App\Http\Controllers\Frontend\TagController;

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

Route::get('/test', TestController::class);

/***************
 * CACHE CLEAR *
 ***************/
Route::get('clear', CacheClearController::class)->name('clear');

/**********************************************************
 * GET LATEST VERSION OF THE WEBSITE SOFTWARE FROM GITHUB *
 **********************************************************/
Route::get('upgrade', UpgradeSoftwareController::class)->name('upgrade');

/****************************************
 * TRANSFER DATA FROM OLD TO NOVA PANEL *
 ****************************************/

Route::get('transfer', StackToNovaController::class);

/***************************
 * TRANSFER DATA TO FLARUM *
 ***************************/

/*************************************************
 * SCRAPE POST URL FROM STACKOVERFLOW PAGINATION *
 *************************************************/
/**********************************
 * SCRAPE STACKOVERFLOW POST DATA *
 **********************************/

/***********************************
 * GOOGLE & BING INDEXING REQUESTS *
 ***********************************/

/**************************
 * SEARCH ENGINE INDEXING *
 **************************/
Route::get('google-index', [GoogleIndexingController::class, 'google_indexing'])->name('google-index');
Route::get('bing-index', [BingIndexingController::class, 'bing_indexing'])->name('bing-index');


/**************************
 * FRONTEND POST PAGES *
 **************************/
Route::get('/',[HomeController::class,'home'])->name('home.index');
Route::get(config('value.POST_SLUG') .'/{slug}',[PostController::class,'show'])->name('post.show');
Route::get('/tag/{tag_slug}',[TagController::class,'TagShow'])->name('tag.show');
