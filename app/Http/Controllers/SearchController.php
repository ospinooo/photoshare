<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller{
    public function index(){
        return view('search.search');
    }
    public function search(Request $request){
        if($request->ajax()){
            $output="";
            $posts=DB::table('posts')->where('title','LIKE','%'.$request->search."%")->get();
            if($posts){
                foreach ($posts as $key => $post) {
                    $output.='<tr>'.
                    '<td>'.$posts->id.'</td>'.
                    '<td>'.$posts->title.'</td>'.
                    '<td>'.$posts->body.'</td>'.
                    '</tr>';
                }
                return Response($output);
            }
        }
    }
}