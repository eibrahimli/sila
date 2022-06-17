<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AdminBannerController extends Controller
{
    public function index() {        

        return view('backend.banner.index');
    }


    public function all() {
        $banners = Banner::all()->sortByDesc('id');
        return response()->json(['banners' => $banners]);
    }

    public function store(Request $request) {        
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|image|mimes:png,jpg,jpeg,svg,gif'
        ]);

        if($validator->fails()): return response()->json(['mes' => 'Göndərilən məlumatlar doğru deil'],422); endif;

        try{

            $banner = new Banner;

            $banner->photo = $request->file->store('uploads/banners','public');

            $banner->save();

            return response()->json(['mes' => 'Banner uğurlu şəkildə əlavə edildi..'],200);

        } catch(\Exception $e) {
            return response()->json(['mes' => 'Banner əlavə edərkən xəta baş verdi'],422);
        }
    }

    public function destroy(Request $request) {
        if (empty($request->checkedNames)) {
            return response()->json(['error' => 'Silinəcək banner seçməmisiniz!!'], 422);
        } else {
        try {
            foreach ($request->checkedNames as $banner):
            $banner = Banner::find($banner);
            Storage::delete('public/' . $banner->photo);
            $banner->delete();
            endforeach;
    
            return response()->json(['mes' => 'Banner uğurlu şəkildə silindi...'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Banner silinərkən xəta baş verdi!!'], 422);
        }
    
        }
    }
}
