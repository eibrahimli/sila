<?php

namespace App\Http\Controllers\Admin;

use Arr;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Banner\StoreRequest;

class AdminBannerController extends Controller
{
    public function index() {        
        $middle = Banner::where('middle', true)->first();
        return view('backend.banner.index', compact('middle'));
    }


    public function store(StoreRequest $request) {        
        $data = $request->validated();
        
        $exist = Banner::where('middle', true)->first();

        if($exist) {
            Storage::delete('public/' . $exist->photo);
            $exist->delete();
        }

        $banner = Banner::query()->create([
            'middle' => true,
            'link' => $data['link'],
        ]);

        if(Arr::exists($data,'middle')):
            $banner->update([
                'photo' => $request->middle->store('uploads/banner', 'public')
              ]);
      
              $image = Image::make(public_path('storage/' . $banner->photo))->fit(1400, 206);
              $image->save();
        endif;    

        return back()->with('success', 'Banner əlavə edildi');

    }

    public function destroy(Banner $banner) {
        Storage::delete('public/' . $banner->photo);

        $banner->delete();

        return back()->with('response', 'Banner uğurlu şəkildə silindi');
    }
}
