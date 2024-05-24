<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('store',[\App\Http\Controllers\Api\FileController::class,'store']);

Route::post('upload',function (Request $request){
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


return response()->json(['success'=>true]);
});
