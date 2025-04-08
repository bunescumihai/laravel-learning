<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class AuthController extends Controller
{
    function __invoke(){
        return View::first(['auth']);
    }
}
