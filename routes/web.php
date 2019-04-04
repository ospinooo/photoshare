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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', 'PagesController@about');
Route::get('/services','PagesController@services');
Route::resource('posts', 'PostsController');
Route::post('posts/media', 'PostsController@storeMedia')->name('posts.media');
Route::view('/welcome','welcome');
// Route::view('login', 'pages.login');
// Route::view('signup', 'pages.signup');


## Pruebas para entender rutas
Route::get('/prueba/{id}/nombre/{name}', function($id, $name){
    return 'This is the user '. $name . ' with id '. $id;
});
## return the view automatically => BLADE

Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');