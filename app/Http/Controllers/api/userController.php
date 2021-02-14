<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    public function index(){
        $data = User::get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }
    public function register(Request $request){
        $rules = [
            'name' => 'required|string',
            "email" => 'required|unique:users|email',
            "password" => "required|min:8"
        ];
         $data = $request->all();
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
        
        $password = $data['password'];
        $hasPassword = Hash::make($password);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $hasPassword
        ]);
       return response()->json([
            'status' => 'success',
            'message' => 'register berhasil'
        ], 200);
    }

    public function login(Request $request){
        $rules = [
            "email" => 'required|email',
            "password" => "required|min:8"
        ];
         $data = $request->all();
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();
        if(!$user){
            return response()->json([
                'status' => 'Login Failed',
                'message' => 'Email not found',
            ], 401);
        }
        $validatorPassword = Hash::check($password, $user->password);
        if(!$validatorPassword){
            return response()->json([
                'status' => 'Login Failed',
                'message' => 'password not found',
            ], 401);
        }

        return response()->json([
            'status' => 'login success',
            'user' => $user,
        ], 200);
    }
}