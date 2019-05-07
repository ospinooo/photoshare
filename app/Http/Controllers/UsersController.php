<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use PDF;

class UsersController extends Controller
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
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
      $data = User::get();
      // Send data to the view using loadView function of PDF facade
      $pdf = PDF::loadView('pdf.basic', ['data' => $data, 'title'=>'Users']);
      // Finally, you can download the file using download function
      return $pdf->stream('users.pdf');
    }


    /**
     *
     *
     */
    public function export_json(){
      $data = User::get();
      $filename = storage_path() . '/tmp/users.json';
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
      $data = User::get();
      $filename = storage_path() . '/tmp/users.csv';
      $fp = fopen($filename, 'w');

      foreach ($data as $line) {
          $myArray = json_decode(json_encode($line), true);
          fputcsv($fp, (array) $myArray,',');
      }
      fclose($fp);
      return response()->download($filename);
    }
}
