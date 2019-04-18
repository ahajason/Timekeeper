<?php

namespace App\Http\Controllers\API;

use App\Model\Category;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function getCategoryList(Request $request)
    {
        $user = Auth::user();
        $userId = $user->user_id;
        //该用户不存在类别，则为其创建
        Category::whereUserId($userId)->firstOrCreate(['user_id' => $userId]);
        $Categories = Category::whereUserId($userId)->with('icon')->get();
        return ['success' => true, 'data' => $Categories];
    }
}
