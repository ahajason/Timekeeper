<?php

namespace App\Http\Controllers;

use Storage;
use Exception;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function portrait(Request $request){
        if (empty($request['file']) || !Storage::exists($request['file'])){
            throw new Exception('文件不存在',10403);
        }
        return Storage::disk('local')->download($request['file']);
    }

}
