<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function requests(){
        return view('backend.pages.requests');
    }
}
