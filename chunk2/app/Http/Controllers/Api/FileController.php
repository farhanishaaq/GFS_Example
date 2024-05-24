<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function store(Request $request){
        $uploadFile = $request->file;
        $file = fopen($uploadFile, 'rb');

        $bufferSize = 25 * 25; // 1MB chunks
        $partNumber = 1;
        while (!feof($file)) {
            $buffer = fread($file, $bufferSize);
            file_put_contents(public_path('files/part_' . $partNumber), $buffer);
            $partNumber++;
        }

        fclose($file);



    }

}
