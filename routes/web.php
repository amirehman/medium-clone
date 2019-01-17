<?php

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

// Route::resource('/articles', 'ArticleController');
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'GuestController@index');
Route::get('/topic/{tag}', 'TagController@show');


Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');



Route::get('/manage', 'DashboardController@index');
Route::prefix('manage')->group(function () {
    Route::get('/dashboard', 'DashboardController@index');
    Route::resource('/tags', 'TagController');
    Route::get('/my-articles', 'ArticleController@myArticles');
    Route::resource('/articles', 'ArticleController');
    Route::resource('/articles/{article}/thumbnails', 'ThumbnailController');
});

Route::get('/{user}/{article}', 'GuestController@singlePost');

