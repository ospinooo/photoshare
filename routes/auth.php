<?php

Route::group(['middleware' => ['admin']], function () {

  Route::get('/', function(){
    return 'Hello world';
  });

});

