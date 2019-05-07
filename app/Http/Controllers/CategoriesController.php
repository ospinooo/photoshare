<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
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
        //
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
      // If you want to store the generated pdf to the server then you can use the store function
      $pdf->save(storage_path().'_filename.pdf');
      // Finally, you can download the file using download function
      return $pdf->download('categories.pdf');
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
}