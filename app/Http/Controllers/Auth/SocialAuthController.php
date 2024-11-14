<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and handle login or registration.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            // Fetch the user from Google using Socialite
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['msg' => 'Google login failed.']);
        }

        // Find or create the user
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // User exists, log them in
            Auth::guard('web')->login($user);
        } else {
            // Create a new user
            $user = new User();
            $user->name = $googleUser->getName();
            $user->email = $googleUser->getEmail();
            $user->password = bcrypt(Str::random(16)); // Generate a random password
            $user->status = 1; // Set user status as active
            $user->avatar = $googleUser->getAvatar() ?: 'default-avatar.png'; // Save user's avatar or set default
            $user->save();

            // Log in the newly created user
            Auth::guard('web')->login($user);
        }

        // Check user status after login
        if ($user->status != 1) {
            Auth::logout();
            return redirect('/login')->withErrors(['msg' => 'Your account is inactive.']);
        }

        // Verify successful login and redirect
        if (Auth::guard('web')->check()) {
            return redirect(RouteServiceProvider::HOME);
        } else {
            return redirect('/login')->withErrors(['msg' => 'Login failed, please try again.']);
        }
    }
    public function redirectToFacebook() 
    { 
        return Socialite::driver('facebook')->redirect(); 
    }

    public function handleFacebookCallback() 
    {
        try {
            // Fetch the user from Google using Socialite
            $googleUser = Socialite::driver('facebook')->user(); 
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['msg' => 'Facebook login failed.']);
        }
 
        $user = User::where('socialLogin_id', $googleUser->getId())->first();
        
        if ($user) {  
            Auth::guard('web')->login($user);
            
        } else { 
            $user = new User();
            $user->name = $googleUser->getName();
            $user->email = $googleUser->getEmail();
            $user->socialLogin_id = $googleUser->getId();
            $user->password = bcrypt(Str::random(16));
            $user->status = 1; // Set user status as active
            $user->avatar = $googleUser->getAvatar() ?: 'default-avatar.png';  
            $user->save();

            // Log in the newly created user
            Auth::guard('web')->login($user);
        }

        // Check user status after login
        if ($user->status != 1) {
            Auth::logout();
            return redirect('/login')->withErrors(['msg' => 'Your account is inactive.']);
        }

        // Verify successful login and redirect
        if (Auth::guard('web')->check()) {
            return redirect(RouteServiceProvider::HOME);
        } else {
            return redirect('/login')->withErrors(['msg' => 'Login failed, please try again.']);
        }
    }
}
