<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Auth;

class CustomerSocialiteController extends Controller
{
    // Google Redirect
    public function redirectToGoogleCustomer()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google Callback
    public function handleGoogleCallbackCustomer()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $this->findOrCreateUser($user, 'google');
        // Role-based redirection after login
        return $this->redirectTo();
    }

    // Facebook Redirect
    public function redirectToFacebookCustomer()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Facebook Callback
    public function handleFacebookCallbackCustomer()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $this->findOrCreateUser($user, 'facebook');

        // Role-based redirection after login
        return $this->redirectTo();
    }

    // Find or create a user and log them in
    private function findOrCreateUser($socialUser, $provider)
    {

        // Check if the user already exists based on email
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            // Create a new user if it does not exist
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => bcrypt('12345678'), // Hash the default password
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ]);



            // Assign the default role (e.g., 'company') to the user
            $user->assignRole('customer');
            $UserInformation = UserInformation::create([
                'user_id' => $user->id,
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
            ]);
        }

        // Log the user in
        Auth::login($user);
    }

    // Role-based Redirection
    public function redirectTo()
    {
        // Get the roles of the authenticated user
        $role = Auth::user()->getRoleNames();
        // Ensure it's an array and has at least one role
        if (is_array($role) && count($role) > 0) {
            switch ($role[0]) {
                case 'customer':
                    return redirect('customer/dashboard'); // Redirect to company dashboard
                default:
                    return redirect('login'); // Default redirection if role is not matched
            }
        }

        // Fallback if no roles are assigned
        return redirect('customer/dashboard');
    }
}