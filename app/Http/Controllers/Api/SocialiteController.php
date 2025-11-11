<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; // Correctly import this!
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    // Google Redirect
    public function redirectToGoogle()
    {
        $url = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
        return response()->json(['url' => $url], 200);
    }

    // Google Callback
    public function handleGoogleCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->stateless()->user();
            $user = $this->findOrCreateUser($socialUser, 'google');

            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Authentication failed'], 500);
        }
    }

    // Facebook Redirect
    public function redirectToFacebook()
    {
        $url = Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl();
        return response()->json(['url' => $url], 200);
    }

    // Facebook Callback
    public function handleFacebookCallback()
    {
        try {
            $socialUser = Socialite::driver('facebook')->stateless()->user();
            $user = $this->findOrCreateUser($socialUser, 'facebook');

            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Authentication failed'], 500);
        }
    }

    private function findOrCreateUser($socialUser, $provider)
    {
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => bcrypt('12345678'),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ]);

            $user->assignRole('company');

            UserInformation::create([
                'user_id' => $user->id,
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
            ]);
        }

        Auth::login($user);

        return $user;
    }
}
