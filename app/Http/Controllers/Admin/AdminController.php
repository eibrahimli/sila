<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AdminController extends Controller
{
    protected $credentials;

    public function __construct()
    {
        $this->middleware('admin')->except(['loginView', 'loginStore','resetPassword','forgotPassword']);
    }

    public function index()
    {
        return view('backend.index');
    }

    public function loginView()
    {
        return view('backend.login');
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $this->credentials = $request->only(['email', 'password']);

        if (Auth::attempt($this->credentials)) {
            return redirect()->to(route('admin.index'));
        } else {
            return redirect()->back()->withErrors('email', 'Daxil etdiyiniz məlumatlar üzrə bazada bir sitifadəçi yoxdur');
        }
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
    
                $user->setRememberToken(Str::random(60));
    
                event(new PasswordReset($user));
            }
        );
    
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('admin.loginView')->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }
}
