<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\Admin\NewsController;
/*
Route::controller(NewsController::class)->prefix('admin')->group(function() {
    Route::get('news/create', 'add')->middleware('auth');
});
*/
Route::controller(NewsController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('news/create', 'add')->name('news.add');
    Route::post('news/create', 'create')->name('news.create');
    Route::get('news', 'index')->name('news.index');
    Route::get('news/edit', 'edit')->name('news.edit');
    Route::post('news/edit', 'update')->name('news.update');
    Route::get('news/delete', 'delete')->name('news.delete');
});

// 3
use App\Http\Controllers\AAAController;
Route::controller(AAAController::class)->group(function() {
    Route::get('AAAController', 'bbb');
});

// 4
use App\Http\Controllers\Admin\ProfileController;
Route::controller(ProfileController::class)->name('admin.')->middleware('auth')->group(function() {
    Route::get('admin/profile/create','add')->name('profile.add');
    Route::post('admin/profile/create','create')->name('profile.create');
    Route::get('admin/profile', 'index')->name('profile.index');
    Route::get('admin/profile/edit','edit')->name('profile.edit');
    Route::post('admin/profile/edit','update')->name('profile.update');
    Route::get('admin/profile/delete', 'delete')->name('profile.delete');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\NewsController as PublicNewsController;
Route::get('/', [PublicNewsController::class, 'index'])->name('news.index');

use App\Http\Controllers\ProfileController as PublicProfileController;
Route::get('/profile', [PublicProfileController::class, 'index'])->name('profile.index');