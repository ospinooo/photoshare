<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request)
    {
        list($post_id, $user_id) = explode(',', $request->data);
        $like = DB::select('select likes.value from likes where user_id = '. $user_id . ' AND  post_id = ' . $post_id . ';');

        $like_show = 0;
        if (count($like) == 0) {
          $like = new Like();
          $like->user_id = (int) $user_id;
          $like->post_id = (int) $post_id;
          $like->value = 1;
          $like->save();
          $like_show = 1;
          DB::update('update posts set likes = likes + 1 where id = '. $post_id . ';');
        } else {
          $like = $like[0];
          if ($like->value == 1){
            DB::update('update likes set value = False where user_id = '. $user_id . ' AND  post_id = ' . $post_id . ';');
            DB::update('update posts set likes = likes - 1 where id = '. $post_id);
            $like_show = 0;
          } else {
            DB::update('update likes set value = True where user_id = '. $user_id . ' AND  post_id = ' . $post_id . ';');
            DB::update('update posts set likes = likes + 1 where id = '. $post_id);
            $like_show = 1;
          }
        }

        if ($like_show == 1) {
          return '<i class="fas fa-heart fa-2x"></i>';
        } else {
          return '<i class="far fa-heart fa-2x"></i>';
        }
    }
}
