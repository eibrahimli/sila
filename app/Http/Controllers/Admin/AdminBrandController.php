<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AdminBrandController extends Controller
{
    public function index() {
        $brands = Brand::all()->sortByDesc('id');

        return view('backend.brand.index',compact('brands'));
    }

    public function create() {

        return view('backend.brand.create');
    }

    public function store(Request $request) {
        
        $validated_data = $this->validated_data($request,'create');

        $if_color_exists = Brand::where('name', $request->name)->count();

        if($if_color_exists > 0): return back()->with('status', 'error'); endif;
 
        $brand = Brand::create($validated_data);        

        if($request->has('photo')):            
            $brand->update([
                'photo' => $request->photo->store('uploads/brands', 'public')
            ]);

            $image = Image::make(public_path('storage/'.$brand->photo))->fit(166,59);
            $image->save();
        endif;

        return back()->with('status','ok');
    }

    public function edit(Brand $brand) {

        return view('backend.brand.edit',compact('brand'));
    }

    public function update(Brand $brand, Request $request) {            
            
        $validated_data = $this->validated_data($request,'update');
            

        $if_color_exists = Brand::where('name', $request->name)->where('name', '!=', $brand->name)->count();

        if($if_color_exists > 0): return back()->with('status', 'error'); endif;
 
        $brand_photo = $brand->photo;
        $brand->update($validated_data);    
        
        if($request->has('photo')):
            Storage::delete('public/'.$brand_photo);
            $brand->update([
                'photo' => $request->photo->store('uploads/brands', 'public')
            ]);

            $image = Image::make(public_path('storage/'.$brand->photo))->fit(166,59);
            $image->save();
        endif;

        return back()->with('status','ok');
    }

    public function destroy(Brand $brand) {
        
        try{
            Storage::delete('public/'.$brand->photo);
            $brand->delete();
            return back()->with('status', 'ok');
        } catch(\Exception $e) {
            return back()->with('status', 'error');
        }
    }

    public function validated_data($request,$method = 'create') {
        
        if($method == 'create'): 
            $data = $request->validate([
                'name' => 'required|min:2|string',
                'lang' => 'required|string',
                'photo' => 'required|file|image|mimes:jpg,png,gif,jpeg,svg|max:3000'
            ]);
            else:
                $data = $request->validate([
                    'name' => 'required|min:2|string',
                    'lang' => 'required|string',            
                ]);    

                if($request->has('photo') && $request->photo != null)
                    $data['photo'] = $request->validate([
                        'photo' => 'required|file|image|mimes:jpg,png,gif,jpeg,svg|max:3000'
                    ]);
                endif;

        return $data;
    }
}
