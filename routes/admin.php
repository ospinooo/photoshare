<?





Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {

  Route::get('/', function(){
    return view('admin.dashboard');
  });
  Route::resource('posts', 'CategoriesController');
  Route::get('/posts', 'AdminController@postList');
  Route::get('/users', 'AdminController@userList');
  Route::get('/categories', 'AdminController@categoryList');
});
