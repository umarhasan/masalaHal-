<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    // Get Profile
    public function getProfile()
    {
        $user = Auth::user();

        // Check if user exists
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $userInformation = $user->userInformation; // Access userInformation relationship

        return response()->json([
            'message' => 'Profile retrieved successfully.',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'userInformation' => $userInformation,
            ],
        ], 200);
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'nullable',
            'userInformation' => 'nullable',
        ]);
    
        // Retrieve the authenticated user
        $user = User::find(Auth::id());
        
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    
        // Update user basic details
        $user->update($request->only('name', 'email', 'phone'));
    
        // Update or create userInformation
        if ($request->has('userInformation')) {
            $userInformationData = $request->input('userInformation');
            $user->userInformation()->updateOrCreate(
                ['user_id' => $user->id], 
                $userInformationData
            );
        }
    
        // Reload user with userInformation for response
        $updatedUser = $user->load('userInformation');
    
        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $updatedUser,
        ], 200);
    }

    // Change Password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
        ]);

        $user = Auth::user();
        
        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 400);
        }

        // Update password
        $user->update(['password' => Hash::make($request->new_password)]);

        return response()->json(['message' => 'Password changed successfully'], 200);
    }
}
