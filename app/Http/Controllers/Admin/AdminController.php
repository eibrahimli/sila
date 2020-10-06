<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $credentials;

    public function index() {
        return view('backend.index');
    }

    public function loginView() {
        return view('backend.login');
    }

    public function loginStore(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $this->credentials = $request->only(['email','password']);

        if(Auth::attempt($this->credentials)) {
            return redirect()->to(route('admin.index'));
        } else {
            return redirect()->back()->withErrors('email', 'Daxil etdiyiniz məlumatlar üzrə bazada bir sitifadəçi yoxdur');
        }
    }

    public function edit() {
        $setting = Setting::first();

        return view('backend.edit',compact('setting'));
    }

    public function update(Request $request) {
        
    }

    public function setting() {
      $setting = Setting::first();
      return response()->json($setting);
    }

}
