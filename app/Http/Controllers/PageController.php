<?php

namespace App\Http\Controllers;

use App\Models\Req;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function requests(){
        $reqs = Req::all();
        return view('backend.pages.requests', compact('reqs'));
    }
}
