<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post; //For searching posts
use App\User; //For searching users
use App\Category;

class SearchController extends Controller
{
    /**
     * 
     * 
     */
    public function __invoke(Request $request){

        if ($request->key== null || $request->key==''){
            return '<a class="dropdown-item">...</a>';
        }
        
        $categories = DB::table('categories')->where('name','like',"%".$request->key."%")->limit(5)->get();
        return view('include.dropdown')->with('categories', $categories);
    }
}