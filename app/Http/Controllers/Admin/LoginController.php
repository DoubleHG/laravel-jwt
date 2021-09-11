<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // 登录控制器
    public function login()
    {
         $data = Request(['name','password']);
        if (!$token = auth('admin')->claims(['id'=>'456','name'=>'admin'])->attempt($data)) {
            $adminQuery = Admin::query();
            $user = $adminQuery->first();
            return response()->json(['error' => '132132']);
        }
        return $this->respondWithToken($token);
    }

    public function me()
    {
        return auth('admin')->user();
    }

    public function logout()
    {
        return auth('admin')->logout();
    }

    public function refresh()
    {
        return auth('admin')->refresh();
    }

    protected function respondWithToken($token)
    {
        return response()->json([
           'access_token'=>$token,
           'token_type'=>'bearer',
           'expires_in'=> 60
        ]);
    }
}
