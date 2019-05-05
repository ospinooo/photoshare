<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class AdminController extends Controller
{

    /**
     *
     */
    public function postList(Request $request){

      $posts = Post::orderBy('id','desc')->paginate(10);
      return view('admin.database.dashboard')
        ->with('models', $posts)
        ->with('modelController', 'PostsController');
    }
}
