<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
  public function edit()
  {
    $setting = Setting::first();

    return view('backend.edit', compact('setting'));
  }

  public function update(Request $request)
  {
    $data = Validator::make($request->all(), [
      'title' => 'required|min:3',
      'desc' => 'required|min:5',
      'keyw' => 'required|min:3',
      'email' => 'required|email',
      'adress' => 'required|min:3',
      'number' => 'required',
      'social' => 'required',
      'logo' => 'sometimes|file|image|mimes:jpg,jpeg,png,gif,svg'
    ]);

    if ($data->fails()) {
      return response()->json($data->errors(), 400);
    } else {
      $setting = Setting::first();

      $setting->update($request->except(['created_at', 'updated_at', 'id']));

      if ($request->has('logo')) {
        Storage::delete('public/'.$setting->logo);
        $setting->update([
          'logo' => $request->logo->store('uploads', 'public')
        ]);

      }

      return response()->json(['mes' => 'Ayarlar uğurla yeniləndi...', 'setting' => $setting], 200);
    }
  }

  public function settings()
  {
    $setting = Setting::first();

    return response()->json($setting);
  }
}
