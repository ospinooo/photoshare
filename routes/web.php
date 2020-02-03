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

/**
 * Main Pages
 * Search
 * About
 * Services
 */
Route::get('/', 'PostsController@rankingIndex');
Route::get('/search', 'SearchController');
Route::get('/about', 'PagesController@about');
Route::get('/services','PagesController@services');

/**
 * Resource which is the post.
 * Creates all:
 * - POST
 * - GET
 * - PUT
 * -
 *
 */
Route::resource('posts', 'PostsController');
Route::post('posts/media', 'PostsController@storeMedia')->name('posts.media');

Route::get('categories/{category}', 'CategoriesController@show')->name('categories.show');
Route::get('user/{user}', 'UsersController@show')->name('user.show');

/**
 * Authorization.
 * - For the rest of the following routes you need to be logged.
 * - Otherwise it will redirect you to login.
 */
Auth::routes();
Auth::routes(['verify' => true]);

/**
 * User Home Screen.
 */
Route::get('/home', 'HomeController@index')->name('home');

/**
 * Logout.
 */
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

/**
 * Like a post.
 * - Route to like a post.
 */
Route::get('/like', 'LikesController@like')->name('like');
