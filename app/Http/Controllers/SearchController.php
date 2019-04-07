<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; //For searching posts
use App\User; //For searching users

class SearchController extends Controller
{
    public function __invoke(){
        //Mostrar resultados
        $query = $_GET['query'];
        return "Mostrando resultados para {$query}";
    }
}


