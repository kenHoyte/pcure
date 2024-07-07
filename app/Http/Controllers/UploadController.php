<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    //
    public function uploadFile(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'attachment' => 'required|file|mimes:xls,xlsx,csv,txt,pdf,doc,docx',
        ]);

        $user_id = Auth::user()->id;
        $fileInputName = time() . $user_id ."." .$request->file('attachment')->extension();
        $file_exp = explode('.', $fileInputName);
        $file_ext = $file_exp[1];
        $move_file = $request->file('attachment')->move(public_path('uploads'), $fileInputName);

        

        if ($move_file) {
            Upload::create([
                'file_name' => $request->title,
                'file_path' => $fileInputName,
                'file_type' => $file_ext,
                'user_id' => $user_id,
            ]);

            return redirect()->back()->with('success', 'File uploaded successfully');
        } else {
            return redirect()->back()->with('error', 'File upload failed');
        }
    }
}
