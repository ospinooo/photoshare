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

include 'admin.php';
include 'auth.php';

//
Route::get('/', 'PostsController@rankingIndex');
Route::get('/search', 'SearchController');
Route::get('/about', 'PagesController@about');
Route::get('/services','PagesController@services');

//
Route::resource('posts', 'PostsController');
Route::post('posts/media', 'PostsController@storeMedia')->name('posts.media');

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/like', 'LikesController@like')->name('like');
