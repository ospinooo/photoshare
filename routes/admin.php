<?


Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

  Route::get('/', function(){
    return view('admin.dashboard');
  });


  Route::get('users/pdf','UsersController@export_pdf');
  Route::get('categories/pdf','CategoriesController@export_pdf');
  Route::get('posts/pdf','PostsController@export_pdf');

  Route::get('users/json','UsersController@export_json');
  Route::get('categories/json','CategoriesController@export_json');
  Route::get('posts/json','PostsController@export_json');



  Route::resource('categories', 'CategoriesController');

  Route::get('/posts', 'AdminController@postList');
  Route::get('/users', 'AdminController@userList');
  Route::get('/categories', 'AdminController@categoryList');
});
