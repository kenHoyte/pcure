<?php

namespace App\Http\Controllers;

use App\Models\Req;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestsController extends Controller
{
    public function addRequest(Request $request){
        $request->validate ([
            'item'=> 'required|string',
            'attachment' => 'file|mimes:xls,xlsx,csv,txt,pdf,doc,docx',
            // 'excel' => 'required|mimes:xls,xlsx|max:2048',
        ]);
        $user = Auth::user();

        $req = Req::create([
            'item'=> $request->item,
            'req_remark'=> $request->req_remark,
            'requester_id'=> $user->id,
            'location'=> $request->location,
            'branch'=> $user->branch,
        ]);

        
        $fileInputName = time() . $user->id ."." .$request->file('attachment')->extension();
        $file_exp = explode('.', $fileInputName);
        $file_ext = $file_exp[1];
        $move_file = $request->file('attachment')->move(public_path('uploads'), $fileInputName);

        

        if ($move_file) {
            Upload::create([
                'file_name' => $req->item . " " . 'Attachment',
                'req_id' => $req->id,
                'file_path' => $fileInputName,
                'file_type' => $file_ext,
                'user_id' => $user->id,
            ]);

            return redirect()->back()->with('success', 'File uploaded successfully');
        } else {
            return redirect()->back()->with('error', 'File upload failed');
        }

        return redirect()->back()->with('success','Request added successfully');
    }

    public function approveRequest(Req $req){

        if(Auth::user()->role !== 'manager'){
            return redirect()->back()->with('error','Could not perform action!');
        }

        $req->update([
            'approved' => true,
            'approver_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('success','Request Approved');
    }

    public function authorizeRequest(Req $req){

        if(Auth::user()->role !== 'officer'){
            return redirect()->back()->with('error','Could not perform action!');
        }

        $req->update([
            'authorized' => true,
            'authorizer_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('success','Request Authorized');
    }
}