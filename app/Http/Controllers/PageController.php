<?php

namespace App\Http\Controllers;

use App\Models\Req;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    //
    public function requests(){
        if(Auth::user()->role == 'officer'){
            $reqs = Req::with('requester', 'approver')->where('approved', true)->get();
        }else{
            $reqs = Req::with('requester')->get();
        }
        return view('backend.pages.requests', compact('reqs'));
    }

    public function transfers(){
        if(Auth::user()->role == 'officer'){
            $reqs = Req::with('requester', 'approver')->where('approved', true)->get();
        }else{
            $reqs = Req::with('requester')->get();
        }
        return view('backend.pages.transfers', compact('reqs'));
    }
    public function assets(){
        if(Auth::user()->role == 'officer'){
            $reqs = Req::with('requester', 'approver')->where('approved', true)->get();
        }else{
            $reqs = Req::with('requester')->get();
        }
        return view('backend.pages.assets', compact('reqs'));
    }

    public function uploads(){
        $uploads = DB::table('uploads')->latest()->paginate(5);
        return view('backend.pages.uploads', compact('uploads'));
    }
}
