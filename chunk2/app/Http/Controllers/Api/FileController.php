<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function store(Request $request)
    {
        $uploadFile = $request->file;


            $file = fopen($uploadFile, 'rb');
            $fileSizeInBytes = $request->file('file')->getSize();
            $fileSizeInBytesConst = $request->file('file')->getSize();
            $bufferSize = 25 * 25; // 1MB chunks
            $partNumber = 1;
            while (!feof($file)) {
                $buffer = fread($file, $bufferSize);
                $snpdata = $fileSizeInBytes -= $bufferSize;
                if ($snpdata < ($fileSizeInBytesConst / 2)) {
                    file_put_contents(public_path('files/part_' . $partNumber), $buffer);
                    $partNumber++;
                } else {
                    file_put_contents(public_path('files/part_snap_' . $partNumber), $buffer);
                    $partNumber++;
                }
            }
//        $fileSizeInMB = round($uploadFile / (1024 * 1024), 2);

            fclose($file);


            return response()->json(['success' => true]);


    }

    public function getFileById($id)
    {
        $partNumber = 1;
        $newFile = 'combined_file.png';
        $handle = fopen(public_path('storage/' . $newFile), 'a');
        while (file_exists(public_path('files/part_' . $partNumber))) {
            $chunk = file_get_contents(public_path('files/part_' . $partNumber));
            // Process the chunk as needed
            // ...
            fwrite($handle, $chunk);
            $partNumber++;
        }
        fclose($handle);

        $nefilestorage = public_path('storage/' . $newFile);
        return response()->download($nefilestorage);
    }


}
