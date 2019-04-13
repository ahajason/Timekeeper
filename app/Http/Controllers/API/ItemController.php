<?php

namespace App\Http\Controllers\API;

use App\Model\Category;
use App\Model\Item;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ItemController extends Controller
{
    public function createItem(Request $request)
    {
        $user = Auth::user();
        $userId = $user->user_id;
        $request->validate([
            'sync_key' => 'required|max:50|min:3|unique:items,item_sync_key',
            'name' => 'required|max:50|min:3',
            'emergency_level' => 'required|integer|between:0,10',
            'importance_level' => 'required|integer|between:0,10',
            'category_id' => 'required',
        ]);
        //该用户不存在类别，则为其创建
        Category::whereUserId($userId)->firstOrCreate(['user_id' => $userId]);
        //该类别不存在或不属于该用户，则抛出异常
        Category::whereUserId($userId)->findOrFail($request['category_id']);
        Item::updateOrCreate(['item_sync_key' => $request['sync_key']], [
            'item_name' => $request['name'],
            'item_emergency_level' => $request['emergency_level'],
            'item_importance_level' => $request['importance_level'],
            'category_id' => $request['category_id'],
        ]);
        return ['success' => true];
    }

    public function getTodayTodoList(Request $request)
    {
        $user = Auth::user();
        $userId = $user->user_id;
        $today = Carbon::now();
        $todayStart = $today->startOfDay()->toDateTimeString();
        $todayEnd = $today->endOfDay()->toDateTimeString();
        //建立冗余字段进行查询或分次查询，现在数据量较少采用后者
        $Categories = Category::whereUserId($userId)->get(['category_id']);
        $items = Item::whereItemState(Item::ITEM_STATE_TODO)
            ->whereIn('category_id', $Categories)
            ->WhereBetween('item_created_at', [$todayStart, $todayEnd])
            ->get();
        return ['success' => true, 'data' => $items];
    }
    public function getTodoList(Request $request)
    {
        $user = Auth::user();
        $userId = $user->user_id;
        $Categories = Category::whereUserId($userId)->get(['category_id']);
        $items = Item::whereItemState(Item::ITEM_STATE_TODO)
            ->whereIn('category_id', $Categories)
            ->with('category')
            ->get();
        return ['success' => true, 'data' => $items];
    }

}
