<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{



    public function login(Request $request){
        $credentials = $request->only(['email','password']);

        $token = auth('api')->attempt($credentials);

        if (!$token){
            return response()->json(['message'=>'Invalid credentials'],401);
        }

        return [
            'token' => $token,
            'user' => auth('api')->user()
        ];
    }


    public function register(RegisterRequest $request){
        info($request);
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $token = auth('api')->login($user);

        return [
            'token' => $token,
            'user' => $user
        ];
    }

    public function logout(){
        return auth('api')->logout();

        return response()->json(['success'=>true]);
    }

    public function me(){
        return auth('api')->user();
    }

    public function refreshToken(){
        $token = auth('api')->refresh();

        return ['token'=> $token];
    }
}
