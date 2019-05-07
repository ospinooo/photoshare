<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\User;

class AdminController extends Controller
{

    /**
     *
     */
    public function postList(Request $request){
      $posts = Post::orderBy('id','desc')->paginate(10);
      return view('admin.database.dashboard')
        ->with('table', 'posts')
        ->with('title', 'Posts')
        ->with('models', $posts)
        ->with('modelController', 'PostsController');
    }


        /**
     *
     */
    public function userList(Request $request){
      $users = User::orderBy('id','desc')->paginate(10);
      return view('admin.database.dashboard')
        ->with('table', 'users')
        ->with('title', 'Users')
        ->with('models', $users)
        ->with('modelController', 'PostsController');
    }

        /**
     *
     */
    public function categoryList(Request $request){
      $categories = Category::orderBy('id','desc')->paginate(10);
      return view('admin.database.dashboard')
        ->with('table', 'categories')
        ->with('title', 'Categories')
        ->with('models', $categories)
        ->with('modelController', 'CategoriesController');
    }
}
