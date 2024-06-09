<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\file;
use App\Models\MataFile;
use App\Models\MetaFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FileController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileSizeInBytes = $request->file('file')->getSize();
            $fileSizeInMB = round($fileSizeInBytes / (1024 * 1024), 2);
            $fileName = $request->file('file')->getClientOriginalName();
            $stringWithoutWhitespace = preg_replace('/\s+/', '', $fileName);
            $fileData = MetaFile::create([
                'file_name' => $stringWithoutWhitespace,
                'file_size' => $fileSizeInMB,
                'frame_size' => 25 * 25,
                'file_url' => $request->file('file')->store('files', 'public'),
                'user_id' => 1,
            ]);



          $res01 =   $this->chuck1Store($file);
           $res02 = $this->chuck2Store($file);

        }

        return response()->json(['success' => true]);


    }



    public function chuck1Store($file)
    {


        $url = 'http://127.0.0.1:8001/api/store';

        // Send file via POST request
        $response = Http::attach(
            'file', // Name of the field
            file_get_contents($file->getRealPath()), // File contents
            $file->getClientOriginalName() // Original file name
        )->post($url);


        return response()->json(['success'=>true,'data'=>$response]) ;

    }
    public function chuck2Store($file)
    {

        $url = 'http://127.0.0.1:8002/api/store';

        // Send file via POST request
        $response = Http::attach(
            'file', // Name of the field
            file_get_contents($file->getRealPath()), // File contents
            $file->getClientOriginalName() // Original file name
        )->post($url);


        return response()->json(['success'=>true,'data'=>$response]) ;
        return response()->json(['success'=>true,'data'=>$response]) ;

    }
}
