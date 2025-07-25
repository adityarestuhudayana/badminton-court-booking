<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        if ($request->has('error')) {
            return redirect('/');
        }

        $googleUser = Socialite::driver('google')->user();

        $isUserAlreadyRegistered = User::firstWhere('google_id', $googleUser->id);

        if (!$isUserAlreadyRegistered) {
            $userNameInArray = explode(' ', $googleUser->name);

            $userFirstName = $userNameInArray[0];
            $userLastName = isset($userNameInArray[1]) ? implode(' ', array_slice($userNameInArray, 1)) : '';

            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'first_name' => $userFirstName,
                'last_name' => $userLastName,
                'email' => $googleUser->email,
                'profile_image_url' => $googleUser->avatar,
                'password' => Hash::make('123'),
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);

            Auth::login($user);

            return redirect('/dashboard');
        }

        Auth::login($isUserAlreadyRegistered);

        return redirect('/dashboard');
    }
}
