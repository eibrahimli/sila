<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function giris(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'rememberCheckbox' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 200);
        }

        try {
            $this->credentials = $request->only(['email', 'password']);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password],$request->rememberCheckbox)) :
                return response()->json(['mes' => 'Uğurla giriş etdiniz','user' => Auth::user()],200);
            else:
                return response()->json(['mes' => 'Email və ya şifrə səhvdir'],422);   
            endif;
        } catch (Exception $e) {
            return response(['mes' => 'Giriş edərkən nəsə xəta baş verdi'], 422);
        }
    }
    public function qeydiyyat(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 200);
        }

        try {
            $user = User::create(['email' => $request->email, 'password' => Hash::make($request->password)]);
            if ($user) {
                $this->credentials = $request->only(['email', 'password']);

                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) :
                    return response()->json(['mes' => 'Uğurla qeydiyyatdan keçdiniz']);
                endif;
            }
        } catch (Exception $e) {
            return response(['mes' => 'Qeydiyyatdan keçərkən nəsə xəta baş verdi'], 422);
        }
    }

    public function loginregister() {
        return view('frontend.user.logreg');
    }

    public function sendResetMail(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $user = User::where('email', $request->email)->first();

            if ($user):
                $status = Password::sendResetLink(
                    $request->only('email')
                );
                return $status === Password::RESET_LINK_SENT
                ? response()->json(['mes' => 'Şifrə sıfırlama linki email hesabınıza göndərildi. Email gələnlər qutunuzu zəhmət olmasa yoxlayın...'],200) : response()->json(['error' => 'Giriş edərkən nəsə xəta baş verdi'], 422);
            else:
                return response(['error' => 'Belə bir istifadəçi bazada mövcud deil'], 422);   
            endif;
        } catch (Exception $e) {
            return response(['error' => 'Mail göndərilirkən nəsə xəta baş verdi'], 422);
        }
    }

    public function resetPassword(Request $request) {
        $validator = Validator::make($request->all(),[
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()],422);
        }

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
                    ? response()->json(['mes' => 'Şifrəniz uğurla sıfırlandı'],200)
                    : response()->json(['error' => 'Şifrənizi sıfırlaya bilmədik.Yenidən yoxlayın...'],422);
    }

    public function singleUser(User $user) {
      return response()->json(['user' => Auth::user()]);
    }
}
