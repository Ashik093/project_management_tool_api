<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function register(Request $request)
    {
        try{
            $attr = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:6'
            ]);
    
            $user = User::create([
                'name' => $attr['name'],
                'password' => Hash::make($attr['password']),
                'email' => $attr['email']
            ]);
    
            return response()->json([
                'token' => $user->createToken('API Token')->plainTextToken
            ]);
          
        }catch(\Exception $e){
          
              return $e->getMessage();
          }
        
    }
    public function login(Request $request)
    {
        try {
            $attr = $request->validate([
                'email' => 'required|string|email|',
                'password' => 'required|string|min:6'
            ]);
    
            if (!Auth::attempt($attr)) {
                return response()->json('Credentials not match', 401);
            }
    
            return response()->json([
                'token' => auth()->user()->createToken('API Token')->plainTextToken
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return [
                'message' => 'Tokens Revoked'
            ];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
