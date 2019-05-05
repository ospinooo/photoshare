<?





Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {

  Route::get('/', function(){
    return view('admin.database.dashboard');
  });

  Route::get('/posts', 'AdminController@postList');
});
