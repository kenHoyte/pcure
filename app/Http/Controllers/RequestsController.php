<?php

namespace App\Http\Controllers;

use App\Models\Req;
use Illuminate\Http\Request;

class RequestsController extends Controller
{
    public function addRequest(Request $request){
        $request->validate ([
            'title'=> 'required|string',
            'request_item'=> 'required|string',
            // 'excel' => 'required|mimes:xls,xlsx|max:2048',
        ]);

        $req = Req::create([
            'title'=> $request->title,
            'request_item'=> $request->request_item
        ]);

        return redirect()->back()->with('success','Request added successfully');
    }
}