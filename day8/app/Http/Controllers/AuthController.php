<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\DB; 

class AuthController extends Controller
{
    
    

    public function createUser(Request $request)
    {
        try {
            
            $validateUser = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8'
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => "Validation failed",
                    'errors' => $validateUser->errors()
                ], 422); 
            }

            // 2. User Creation
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            
            event(new Registered($user));

            // 4. Return Token
            return response()->json([
                'status' => true,
                'message' => "User created successfully. Verification link sent to email.",
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ], 201); 

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                "message" => $th->getMessage()
            ], 500);
        }
    }

    // --- API: Login ---

    public function loginUser(Request $request)
    {
        try {
            
            $validateUser = Validator::make($request->all(), [
                'email' => 'email|required',
                'password' => 'required'
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => "Invalid data entered",
                    "errors" => $validateUser->errors()
                ], 422);
            }
            
           
            if (!Auth::attempt($request->only(["email", "password"]))) {
                
                return response()->json([
                    'status' => false,
                    'message' => "Invalid credentials. Either email or password is wrong."
                ], 401); 
            }
            
            
            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => "User Logged in successfully",
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                "message" => $th->getMessage()
            ], 500);
        }
    }



    public function logout(Request $request)
    {
        try {
            
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'User logged out successfully'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    
 

   
}