<?


Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

  Route::get('/', function(){
    return redirect('admin/posts');
  });


  Route::get('users/pdf','UsersController@export_pdf');
  Route::get('categories/pdf','CategoriesController@export_pdf');
  Route::get('posts/pdf','PostsController@export_pdf');

  Route::get('users/json','UsersController@export_json');
  Route::get('categories/json','CategoriesController@export_json');
  Route::get('posts/json','PostsController@export_json');

  Route::get('users/csv','UsersController@export_csv');
  Route::get('categories/csv','CategoriesController@export_csv');
  Route::get('posts/csv','PostsController@export_csv');

  Route::resource('users', 'UsersController');
  Route::resource('categories', 'CategoriesController');

  Route::delete('posts/{post}', 'PostsController@destroyAdminposts');
  Route::delete('categories/{category}', 'CategoriesController@destroyAdmincategories');
  Route::delete('users/{user}', 'UsersController@destroyAdminusers');

  Route::post('posts/import_csv', 'PostsController@import_csv')->name('admin.posts.import_csv');
  Route::post('categories/import_csv', 'CategoriesController@import_csv')->name('admin.categories.import_csv');
  Route::post('users/import_csv', 'UsersController@import_csv')->name('admin.users.import_csv');

  Route::get('/posts', 'AdminController@postList');
  Route::get('/users', 'AdminController@userList');
  Route::get('/categories', 'AdminController@categoryList');
});
