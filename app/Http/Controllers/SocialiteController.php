<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{

    public function redirectToGoogle()
    {

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $socialUser = Socialite::driver('google')->stateless()->user();

        $this->findOrCreateUser($socialUser, 'google');

        return $this->redirectTo();
    }


    public function redirectToFacebook()
    {

        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $socialUser = Socialite::driver('facebook')->stateless()->user();
        $this->findOrCreateUser($socialUser, 'facebook');

        return $this->redirectTo();
    }


    // ==========================
    // FIND OR CREATE USER
    // ==========================
    private function findOrCreateUser($socialUser, $provider)
    {

        $role = 'customer'; // default = customer

        // Check if email already exists
        $existingUser = User::where('email', $socialUser->getEmail())->first();

        if ($existingUser) {
            // Just login, do NOT change role
            Auth::login($existingUser);
            return;
        }

        // Create new user
        $user = User::create([
            'name'        => $socialUser->getName(),
            'email'       => $socialUser->getEmail(),
            'password'    => bcrypt('12345678'),
            'provider'    => $provider,
            'provider_id' => $socialUser->getId(),
        ]);

        // Assign role selected on frontend
        $user->assignRole($role);

        // Save basic info
        UserInformation::create([
            'user_id' => $user->id,
            'name'    => $socialUser->getName(),
            'email'   => $socialUser->getEmail(),
        ]);

        Auth::login($user);
    }



    public function redirectTo()
    {
        $role = Auth::user()->getRoleNames()->first();

        if ($role === 'customer') {
            return redirect('/');
        }

        if ($role === 'seller') {
            return redirect('/seller/dashboard');
        }

        if ($role === 'admin') {
            return redirect('/admin/dashboard');
        }

        return redirect('/');
    }
}
