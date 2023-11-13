<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        // $request['password'] = Hash::make($request->password);
        $user = User::create($data);
        $token = $user->createToken('token')->plainTextToken;
        $result = [
            'status' => 'Success',
            'message' => 'Successfully Registered...',
            'data' => $token,
        ];
        return response()->json($result, 200);
    }
    public function login(Request $request){
        $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password)) {
                return response(['error' => 'Please Check Your Password Or Email...']);
            }

            $token = $user->createToken('token')->plainTextToken;
            $result = [
                'status' => 'Success',
                'user' => $user,
                'token' => $token,
            ];
            return response()->json($result, 200);


    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success' => 'Successfully logout...'], 200);
    }
    public function show(){
        $category = Category::get();
        return response()->json([
            'category' => $category
        ],200);
    }
}
