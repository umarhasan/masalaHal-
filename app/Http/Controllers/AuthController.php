<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
     // User Registration
    public function register(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'same:confirm_password'],
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // User Creation
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign Role
        $user->assignRole($request->roles);

            // Create UserInformation if provided
            $userInfoData['user_id'] = $user->id;
            $userInfoData['name'] = $user->name;
            $userInfoData['email'] = $user->email;
            $userInfoData['phone'] = $user->phone;
            // Associate with user
            UserInformation::create($userInfoData);
        
        // Generate Token
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'user' => $user->load('userInformation'),
            'token' => $token,
        ], 201);
    }

     // User Login
     public function login(Request $request)
     {
         $request->validate([
             'email' => 'required|string|email',
             'password' => 'required|string',
         ]);

         if (!Auth::attempt($request->only('email', 'password'))) {
             return response()->json(['error' => 'Unauthorized'], 401);
         }

         $user = Auth::user();
         $token = $user->createToken('API Token')->plainTextToken;

         return response()->json([
             'user' => $user,
             'token' => $token,
         ], 200);
     }
}
