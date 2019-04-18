<?php

namespace App\Http\Controllers\API;

use App\Model\Icon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IconController extends Controller
{
    public function getIconList(Request $request)
    {
        $icons = Icon::all()->keyBy('icon_id');
        return ['success' => true, 'data' => $icons];
    }
}
