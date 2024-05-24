<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\file;
use App\Models\MataFile;
use App\Models\MetaFile;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function store(Request $request)
    {
        if($request->hasFile('file')){
            $fileSizeInBytes = $request->file('file')->getSize();
            $fileSizeInMB = round($fileSizeInBytes / (1024 * 1024), 2);
            $fileName = $request->file('file')->getClientOriginalName();
            $stringWithoutWhitespace = preg_replace('/\s+/', '', $fileName);
            $fileData = MetaFile::create([
            'file_name'=> $stringWithoutWhitespace,
            'file_size'=> $fileSizeInMB,
            'frame_size'=> 25 * 25,
            'file_url'=> $request->file('file')->store('files', 'public'),
            'user_id'=> 1,
            ]);

        }
dd($fileData);



    }
}
