<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $credentials;

    public function index() {
        dd('ok');
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
            dd('Olmadı');
        }
    }
}
