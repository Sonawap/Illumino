<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function register (Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string'
        ]);
        $user = User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=> bcrypt($fields['password']),
        ]);
        $token = $user->createToken('welcomeIllumino')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 200);
    }

    public function login (Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //check email
        $user =User::where('email', $fields['email'])->first();

        //check Password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'msg' => 'Check your details'
            ], 
            400);
        }
        $token = $user->createToken('welcomeIllumino')->plainTextToken;
        $response = [
            'msg'=>'Logged in welcome',
            'user' => $user,
            'token' => $token
        ];
        return response($response, 200);
    }
    
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return[
            'msg'=> 'logged out'
        ];
    }
}
