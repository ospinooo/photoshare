<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Post;
use PDF;
class CategoriesController extends Controller
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
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
          'name' => 'required',
      ]);

      $category = new Category();
      $category->name = $request->input('name');
      $category->save();

      return redirect('admin/categories')->with('success', 'Category Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $posts = Post::where('category_id', $category->id)
          ->paginate(10);
        return view('categories.show')
          ->with('posts', $posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
      return view('categories.edit')
      ->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category->name = $request->input('name');
        $category->save();

        return redirect('admin/categories')->with('success', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }



    /**
     *
     *
     *
     */
    public function export_pdf()
    {
      // Fetch all customers from database
      $data = Category::get();
      // Send data to the view using loadView function of PDF facade
      $pdf = PDF::loadView('pdf.basic', ['data' => $data, 'title'=>'Categories']);
      // Finally, you can download the file using download function
      return $pdf->stream('categories.pdf');
    }


    /**
     *
     *
     */
    public function export_json(){
      $data = Category::get();
      $filename = storage_path() . '/tmp/categories.json';
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
      $data = Category::get();
      $filename = storage_path() . '/tmp/categories.csv';
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
          $category = new Category();
          $category->name = $data[1];
          $category->created_at = $data[2];
          $category->updated_at = $data[3];
          $category->save();
      }
      fclose($fp);

      return redirect('admin/categories')->with('success', 'Categories Uploaded');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroyAdmincategories(Category $category)
    {
        $category->delete();
        return redirect('admin/categories')->with('error', 'Category Deleted');
    }
}
