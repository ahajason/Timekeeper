<?php

namespace App\Http\Controllers\API;

use App\Model\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UseController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function register(Request $request)
    {
        $request->validate([
            'account' => 'required|unique:users,user_account|max:50|min:3',
            'password' => 'required|max:50|min:3',
        ]);

        User::create([
            'user_account' => $request['account'],
            'user_password' => $request['password'],
            'portrait_id' => 0
        ]);
        return  ['success' => true];
    }
}
