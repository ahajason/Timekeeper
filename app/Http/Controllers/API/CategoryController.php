<?php

namespace App\Http\Controllers\API;

use App\Model\Category;
use App\Model\Item;
use App\Model\Plan;
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
        $categories = Category::whereUserId($userId)->with('icon')->get();
        return ['success' => true, 'data' => $categories];
    }

    /**
     * saveCategory
     * @param Request $request
     * @return array
     */
    public function saveCategory(Request $request)
    {
        $request->validate([
            'category_color' => 'required',
            'category_name' => 'required',
            'category_icon_id' => 'required|exists:icons,icon_id',
        ]);
        $user = Auth::user();
        $userId = $user->user_id;

        $categoryId = $request['category_id'];
        $categoryColor = $request['category_color'];
        $categoryName = $request['category_name'];
        $categoryIconId = $request['category_icon_id'];

        //该用户不存在类别，则为其创建
        $category = Category::whereUserId($userId)->findOrNew($categoryId);
        $category->category_color = $categoryColor;
        $category->category_name = $categoryName;
        $category->category_icon_id = $categoryIconId;
        $category->user_id = $userId;
        $category->save();
        $categories = Category::whereUserId($userId)->with('icon')->get();
        return ['success' => true, 'data' => $categories];
    }

    /**
     * deleteCategory
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function deleteCategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
        ]);
        $user = Auth::user();
        $userId = $user->user_id;
        $categoryId = $request['category_id'];
        //验证类别是否所属或是否存在
        Category::whereUserId($userId)->whereCategoryId($categoryId)->firstOrFail();
        Category::whereCategoryId($categoryId)->delete();
        Item::whereCategoryId($categoryId)->delete();
        Plan::whereCategoryId($categoryId)->delete();
        return ['success' => true];
    }





}
