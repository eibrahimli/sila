<?php

namespace App\Http\Controllers\Seller;

use App\Models\Brand;
use App\Models\Color;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class SellerController extends Controller
{
  public function __construct()
  {
    $this->middleware('seller')->except(['login', 'register', 'store', 'loginStore']);
  }

  public function index()
  {
    return view('seller.index');
  }

  public function getUser() {
    return response()->json(['user' => auth()->user()],200);
  }

  public function login()
  {
    return view('seller.login');
  }

  public function loginStore(Request $request)
  {
    $data = $request->validate([
      'email' => 'required|email',
      'password' => 'required|min:8'
    ]);

    try {
      if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // if (!auth()->user()->hasVerifiedEmail()) {
        //   return redirect()->route('verification.notice');
        // }

        return redirect()->route('seller.index');
      }
    } catch (\Exception $e) {
      return redirect()->route('seller.login')->with('status', 'Giriş edərkən nəsə xəta baş verdi');
    }
  }

  public function register()
  {
    return view('seller.register');
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8|confirmed',
      'name' => 'required|min:2|string',
      'surname' => 'required|min:2|string'
    ]);

    try {
      $user = User::create([
        'name' => $request->name,
        'surname' => $request->surname,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'seller'
      ]);

      if ($user) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
          event(new Registered($user));
          return redirect()->route('verification.notice')->with('statusOk', 'Uğurla qeydiyyatdan keçdiniz və emailinizə təsdiq mesajı göndərdik');
        }
      }
    } catch (\Exception $e) {
      return redirect()->route('seller.register')->with('status', 'Qeydiyyatdan keçərkən nəsə xəta baş verdi');
    }
  }

  public function edit(User $user)
  {
    return view('seller.edit', compact('user'));
  }

  public function update(User $user, Request $request) {

    $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
      'name' => 'required|min:2|string',
      'surname' => 'required|min:2|string',
      'email' => 'required|email',
      'password' => 'sometimes|min:8',
      'number' => 'required',
      'bank_account' => 'required|min:16',
      'adress' => 'required|min:5',
      'city' => 'required|string',
    ]);

    if($validator->fails()) {
      return response()->json(['error' => $validator->errors()],422);
    }

    try {
      if(\auth()->user()->update($validator->validated())) {
        return response()->json(['mes' => 'Ayarlarınız uğurla yeniləndi...'],200);
      }

      return response()->json(['error' => 'Ayarlarınız yenilənərkən xəta baş veridi...'],422);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Ayarlarınız yenilənərkən xəta baş veridi...'],422);
    }
  }

  // Ajax request methods

  public function allBrands()
  {
    $brands = Brand::all()->sortByDesc('id');
    foreach ($brands as $brand):
      $data[] = [
        'id' => $brand->id,
        'label' => $brand->name,
      ];
    endforeach;
    return response()->json($data, 200);
  }


  public function allUnits()
  {
    $units = Unit::all()->sortByDesc('id');
    foreach ($units as $unit):
      $data[] = [
        'id' => $unit->id,
        'label' => $unit->name,
      ];
    endforeach;
    return response()->json($data, 200);
  }

  public function allColors()
  {
    $colors = Color::all()->sortByDesc('id');
    foreach ($colors as $color):
      $data[] = [
        'id' => $color->id,
        'label' => $color->name,
      ];
    endforeach;
    return response()->json($data, 200);
  }

}
