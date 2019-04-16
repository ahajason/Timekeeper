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
            'item_sync_key' => 'required|max:50|min:3|unique:items,item_sync_key',
            'item_name' => 'required|max:50|min:3',
            'item_emergency_level' => 'required|integer|between:0,10',
            'item_importance_level' => 'required|integer|between:0,10',
        ]);
        //该类别不存在或不属于该用户，则选择默认类别
        $category = Category::whereUserId($userId)->find($request['category_id']);
        if (empty($category)) {
            //该用户不存在类别，则为其创建
            $category = Category::whereUserId($userId)->firstOrCreate(['user_id' => $userId]);
        }
        $item = Item::Create([
            'item_sync_key' => $request['item_sync_key'],
            'item_name' => $request['item_name'],
            'item_emergency_level' => $request['item_emergency_level'],
            'item_importance_level' => $request['item_importance_level'],
            'category_id' => $category->category_id,
        ]);
        $item->load('category');

        return ['success' => true, 'data' => [$item->item_sync_key => $item]];
    }

    /**
     * completeItem
     * @param Request $request
     * @return array
     */
    public function completeItem(Request $request)
    {
        $request->validate([
            'item_sync_key' => 'required|max:50|min:3',
        ]);
        $item = Item::whereItemSyncKey($request['item_sync_key'])->with('category')->firstOrFail();
        $item->item_closed_at = Carbon::now()->toDateTimeString();
        $item->item_state = Item::ITEM_STATE_DONE;
        $item->save();
        return ['success' => true, 'data' => [$item->item_sync_key => $item]];
    }

    /**
     * completeItem
     * @param Request $request
     * @return array
     */
    public function restartItem(Request $request)
    {
        $request->validate([
            'item_sync_key' => 'required|max:50|min:3',
        ]);
        $item = Item::whereItemSyncKey($request['item_sync_key'])->with('category')->firstOrFail();
        $item->item_closed_at = null;
        $item->item_state = Item::ITEM_STATE_TODO;
        $item->save();
        return ['success' => true, 'data' => [$item->item_sync_key => $item]];
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
        $itemList = $items->keyBy('item_sync_key');
        return ['success' => true, 'data' => $itemList];
    }

    public function getItem(Request $request)
    {
        $request->validate([
            'item_sync_key' => 'required|max:50|min:3',
        ]);
        $item = Item::whereItemSyncKey($request['item_sync_key'])->with('category')->firstOrFail();
        return ['success' => true, 'data' => $item];
    }

    public function updateItem(Request $request)
    {
        $requestParams = [
            'item_sync_key' => 'required|max:50|min:3',
            'item_name' => 'required|max:50|min:3',
            'item_emergency_level' => 'required|integer|between:0,10',
            'item_importance_level' => 'required|integer|between:0,10',
            'category_id' => 'required',
            '$item_forecast_time'=> 'required',
            '$item_description' => 'required',
            '$item_started_at' => 'required',
            '$item_closed_at' => 'required',
        ];
        $request->validate($requestParams);
        $item = Item::whereItemSyncKey($request['item_sync_key'])->firstOrFail();
        foreach ($requestParams as $key => $requestParam) {
            if (is_null($request[$key]) || $key = 'item_sync_key') {
                continue;
            }
            $item->$key = $request[$key];
        }
        $item->save();
        $item->load('category');
        return ['success' => true, 'data' => [$item->item_sync_key => $item]];
    }

}
