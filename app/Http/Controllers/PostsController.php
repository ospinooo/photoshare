<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
class PostsController extends Controller
{
    /**
     *
     */
    public function __construct()
    {

        //Add middleware to controllers $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/');
        //SAME
        //$posts = DB::select('SELECT * FROM posts');
        //$posts = Post::all();
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->get();
        $cat =[];
        for ($i =0; $i<count($categories);$i++) {
            $c = $categories[$i];
            $cat[$c->id] = $c->name;
        }
        return view('posts.create')->with('categories', $cat);
    }

    /**
     * Store a newly created resource in storage.
     * grab variables from the form give in request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // list of rules
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category' => 'required'
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category');
        $post->user_id = Auth::id();

        $post->save();

        // $post = Post::create($request->all());
        foreach ($request->input('document', []) as $file) {
            $post->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('document');
        }

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     * 1 Post
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $user = Auth::user();

        if ($user) {
          $like = DB::select('select likes.like from likes where user_id = '. $user->id . ' AND  post_id = ' . $post->id . ';');
          if (count($like) == 0) {
            $like = False;
          } else {
            $like = $like[0]->like == 1;
          }
          $like = False;
        }


        return view('posts.show')
          ->with('post', $post)
          ->with('like', $like);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = DB::table('categories')->get();
        $cat =[];
        for ($i =0; $i<count($categories);$i++) {
            $c = $categories[$i];
            $cat[$c->id] = $c->name;
        }
        return view('posts.edit')->with('post', $post)->with('categories', $cat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // list of rules
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category' => 'required'
        ]);

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category');
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted');
    }


    /**
     *
     */
    public function storeMedia(Request $request){
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }


    /**
     *
     */
    public function rankingIndex(Request $request){
        $posts = Post::orderBy('likes','desc')->paginate(5);
        return view('posts.ranking')->with('posts', $posts);
    }



    /**
     *
     *
     *
     */
    public function export_pdf()
    {
      // Fetch all customers from database
      $data = Post::get();

      // Send data to the view using loadView function of PDF facade
      $pdf = PDF::loadView('pdf.basic', ['data' => $data, 'title'=>'Posts']);
      // Finally, you can download the file using download function
      return $pdf->stream('posts.pdf');
    }

    /**
     *
     *
     */
    public function export_json(){
      $data = Post::get();
      $filename = storage_path() . '/tmp/posts.json';
      $fp = fopen($filename, 'w');
      fwrite($fp, json_encode($data, JSON_PRETTY_PRINT));
      fclose($fp);
      return response()->download($filename);
    }

    /**
     *
     *
     */
    public function export_csv(){
      $data = Post::get();
      $filename = storage_path() . '/tmp/posts.csv';
      $fp = fopen($filename, 'w');

      foreach ($data as $line) {
          $myArray = json_decode(json_encode($line), true);
          fputcsv($fp, (array) $myArray,',');
      }
      fclose($fp);
      return response()->download($filename);
    }



    /**
     *
     *
     */
    public function import_csv(Request $request){
      $filename = $request->file->getClientOriginalName();
      $request->file->storeAs('csv', $request->file->getClientOriginalName());

      $path = storage_path('app/csv/'. $filename);
      $fp = fopen($path, 'r');
      $row=0;

      while (($data =fgetcsv($fp, 1000, ",")) !== FALSE) {
          $post = new Post();
          $post->title = $data[1];
          $post->body = $data[2];
          $post->created_at = $data[3];
          $post->updated_at = $data[4];
          $post->user_id = $data[5];
          $post->category_id = $data[6];
          $post->likes = $data[7];
          $post->save();
      }
      fclose($fp);
      return redirect('admin/posts')->with('success', 'Posts Uploaded');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroyAdminposts(Post $post)
    {
        $post->delete();
        return redirect('admin/posts')->with('error', 'Post Deleted');
    }

}
