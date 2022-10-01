<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function googleRedirect() {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback() {
        $googleuser = Socialite::driver('google')->user()->getRaw();


        $user = User::updateOrCreate([
            'email' => $googleuser['email']
        ],[
            'name' => $googleuser['given_name'],
            'surname' => $googleuser['family_name']
        ]);

        Auth::login($user);

        return redirect()->route('index');
    }
}
