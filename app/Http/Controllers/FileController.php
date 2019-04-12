<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorCode;
use Storage;
use Exception;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function portrait(Request $request){
        if (empty($request['file']) || !Storage::exists($request['file'])){
            throw new Exception('文件不存在',ErrorCode::ERROR_FILE_NOT_FOUND);
        }
        return Storage::disk('local')->download($request['file']);
    }

}
