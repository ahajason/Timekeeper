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
            'item_sync_key' => 'required|max:50|min:2|unique:items,item_sync_key',
            'item_name' => 'required|max:50|min:2',
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
            'item_sync_key' => 'required|max:50|min:2',
        ]);
        $item = Item::whereItemSyncKey($request['item_sync_key'])->with('category')->firstOrFail();
        $item->item_closed_at = Carbon::now()->toDateTimeString();
        $item->item_state = Item::ITEM_STATE_DONE;
        $item->save();
        return ['success' => true, 'data' => $item];
    }

    /**
     * completeItem
     * @param Request $request
     * @return array
     */
    public function restartItem(Request $request)
    {
        $request->validate([
            'item_sync_key' => 'required|max:50|min:2',
        ]);
        $item = Item::whereItemSyncKey($request['item_sync_key'])->with('category')->firstOrFail();
        $item->item_closed_at = null;
        $item->item_state = Item::ITEM_STATE_TODO;
        $item->save();
        return ['success' => true, 'data' => $item];
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

    /**
     * getTimeLine
     * @param Request $request
     * @return array
     */
    public function getTimeLine(Request $request)
    {
        $user = Auth::user();
        $userId = $user->user_id;
        $Categories = Category::whereUserId($userId)->get(['category_id']);
        $items = Item::whereItemState(Item::ITEM_STATE_DONE)
            ->whereIn('category_id', $Categories)
            ->orderByDesc('item_closed_at')
            ->get();
        $items->load('category.icon');
        $itemList = $items->keyBy('item_sync_key');
        $timeLine = [];
        foreach ($items as $item) {
            if (empty($item->item_closed_at)) {
                continue;
            }
            $carbon = Carbon::createFromTimeString($item->item_closed_at);
            $year = $carbon->year;
            $month = $carbon->month;
            $day = $carbon->day;
            $time = $carbon->toTimeString();
            $timeLine[$year.' '][$month.'/'.$day][$time] = $item->item_sync_key;
        }
        return ['success' => true, 'data' => ['timeLine' => $timeLine, 'itemList' => $itemList]];
    }


    public function getTodoList(Request $request)
    {
        $user = Auth::user();
        $userId = $user->user_id;
        $Categories = Category::whereUserId($userId)->get(['category_id']);
        $items = Item::whereItemState(Item::ITEM_STATE_TODO)
            ->whereIn('category_id', $Categories)
            ->with('category.icon')
            ->get();
        $itemList = $items->keyBy('item_sync_key');
        return ['success' => true, 'data' => $itemList];
    }

    /**
     * getFilteredItems
     * @param Request $request
     * @return array
     */
    public function getFilteredItems(Request $request)
    {
        $request->validate([
            'state' => 'required|integer|between:0,2',
            'importance_level' => 'required|integer|between:0,2',
            'emergency_level' => 'required|integer|between:0,2',
        ]);
        $stateFilter = $request['state'];
        $importanceFilter = $request['importance_level'];
        $emergencyFilter = $request['emergency_level'];
        $user = Auth::user();
        $userId = $user->user_id;
        $Categories = Category::whereUserId($userId)->get(['category_id']);
        $query = Item::whereIn('category_id', $Categories)
            ->orderByDesc('item_created_at');
        if ($stateFilter == 1) {
            $query->whereItemState(Item::ITEM_STATE_TODO);
        } else if ($stateFilter == 2) {
            $query->whereItemState(Item::ITEM_STATE_DONE);
        }
        if ($importanceFilter == 1) {
            $query->where('item_importance_level', '>=', 5);
        } else if ($importanceFilter == 2) {
            $query->where('item_importance_level', '<', 5);
        }
        if ($emergencyFilter == 1) {
            $query->where('item_emergency_level', '>=', 5);
        } else if ($emergencyFilter == 2) {
            $query->where('item_emergency_level', '<', 5);
        }
        $items = $query->with('category')->get();
        $itemList = $items->keyBy('item_sync_key');
        return ['success' => true, 'data' => $itemList];
    }

    public function getItem(Request $request)
    {
        $request->validate([
            'item_sync_key' => 'required|max:50|min:2',
        ]);
        $item = Item::whereItemSyncKey($request['item_sync_key'])->with('category')->firstOrFail();
        return ['success' => true, 'data' => $item];
    }

    public function updateItem(Request $request)
    {
        $requestParams = [
            'item_sync_key' => 'required|max:50|min:2',
            'item_name' => 'required|max:50|min:2',
            'item_emergency_level' => 'required|integer|between:0,10',
            'item_importance_level' => 'required|integer|between:0,10',
            'category_id' => 'required',
            'item_forecast_time' => 'required',
            'item_description' => '',
            'item_started_at' => '',
            'item_closed_at' => '',
        ];
        $request->validate($requestParams);
        $item = Item::whereItemSyncKey($request['item_sync_key'])->firstOrFail();
        foreach ($requestParams as $key => $requestParam) {
            if (is_null($request[$key]) || $key == 'item_sync_key') {
                continue;
            }
            $item->$key = $request[$key];
        }
        $item->save();
        $item->load('category');
        return ['success' => true, 'data' => [$item->item_sync_key => $item]];
    }

    public function deleteItem(Request $request)
    {
        $request->validate([
            'item_sync_key' => 'required|max:50|min:2',
        ]);
        Item::whereItemSyncKey($request['item_sync_key'])->delete();
        return ['success' => true];
    }

    public function recordTomatoes(Request $request)
    {
        $request->validate([
            'tomatoes' => 'required',
        ]);
        foreach (json_decode($request['tomatoes']) as $item_sync_key => $used_time) {
            $item = Item::whereItemSyncKey($item_sync_key)->with('category')->firstOrFail();
            $item->item_tomatoes = intval(round($used_time * 10 / (25 * 60))) + $item->item_tomatoes;
            $item->save();
        }
        $user = Auth::user();
        $userId = $user->user_id;
        $Categories = Category::whereUserId($userId)->get(['category_id']);
        $items = Item::whereItemState(Item::ITEM_STATE_TODO)
            ->whereIn('category_id', $Categories)
            ->with('category.icon')
            ->get();
        $itemList = $items->keyBy('item_sync_key');
        return ['success' => true, 'data' => $itemList];
    }

    public function completeItemByCountdown(Request $request)
    {
        $request->validate([
            'item_sync_key' => 'required|max:50|min:2',
            'item_forecast_time' => 'required|integer',
            'item_started_at' => 'required',
            'item_closed_at' => 'required',
            'effective_time' => 'required',
        ]);

        $effective_time = $request['$effective_time'];
        $itemSyncKey = $request['item_sync_key'];
        $item_forecast_time = $request['item_forecast_time'] * 60;
        $item_started_at = Carbon::createFromTimestamp($request['item_started_at'])->toDateTimeString();
        $item_closed_at = Carbon::createFromTimestamp($request['item_closed_at'])->toDateTimeString();;
        $item = Item::whereItemSyncKey($itemSyncKey)->firstOrFail();
        $item->item_forecast_time = $item_forecast_time;
        $item->item_started_at = $item_started_at;
        $item->item_closed_at = $item_closed_at;
        $item->item_state = Item::ITEM_STATE_DONE;
        $item->item_tomatoes = intval(round($effective_time * 10 / (25 * 60))) + $item->item_tomatoes;;
        $item->save();

        $user = Auth::user();
        $userId = $user->user_id;
        $Categories = Category::whereUserId($userId)->get(['category_id']);
        $items = Item::whereItemState(Item::ITEM_STATE_TODO)
            ->whereIn('category_id', $Categories)
            ->with('category.icon')
            ->get();
        $itemList = $items->keyBy('item_sync_key');
        return ['success' => true, 'data' => $itemList];
    }

}
