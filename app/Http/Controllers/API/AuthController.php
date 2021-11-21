<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;


class AuthController extends Controller
{
    public function register (RegisterUserRequest $request){
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password= bcrypt($request->password);
        $user->save();
        $token = $user->createToken($request->email)->plainTextToken;
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => $token
        ],200);
    }

    public function login (LoginUserRequest $request){
        if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){
            $user = auth()->user();
            $token =  $user->createToken($user->email .' Personal Access Token')->plainTextToken;
            return response()->json([
                'status' => 'success',
                'token' => $token,
                'user' => $user,
            ], 200);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'Unauthorised'
            ], 401);
        }
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Logged Out'
        ], 200);
    }

    
}
