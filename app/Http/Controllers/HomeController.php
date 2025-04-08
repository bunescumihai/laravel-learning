<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    function __invoke(){
        return view('home');
    }
}
