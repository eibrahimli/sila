<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class SiteController extends Controller
{
    public function index() {        
        return view('frontend.index');
    }

    public function getAllColors() {

      $colors = Color::all();

      return response()->json(['colors' => $colors],200);
    }

    public function getAllBrands() {

      $brands = Brand::all();

      return response()->json(['brands' => $brands],200);
    }

    public function sendResetEmailLink(Request $request) {
        $request->validate(['email' => 'required|email']);


        $status = Password::sendResetLink(
            $request->only('email')
        );



        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('index');
    }
}
