<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Str;

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

    public function facebookRedirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback() {
        $facebookuser = Socialite::driver('facebook')->user()->getRaw();
        $full_name = Str::of($facebookuser['name'])->explode(' ');

        $user = User::updateOrCreate([
            'email' => $facebookuser['email']
        ],[
            'name' => $full_name[0],
            'surname' => $full_name[1]
        ]);

        Auth::login($user);

        return redirect()->route('index');
    }
}
