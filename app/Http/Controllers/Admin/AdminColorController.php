<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;

class AdminColorController extends Controller
{
    public function index() {
        $colors = Color::all()->sortByDesc('id');

        return view('backend.color.index',compact('colors'));
    }

    public function create() {

        return view('backend.color.create');
    }

    public function store(Request $request) {
        
        $validated_data = $this->validated_data($request);

        $if_color_exists = Color::where('name', $request->name)->count();

        if($if_color_exists > 0): return back()->with('status', 'error'); endif;
 
        Color::create($validated_data);        

        return back()->with('status','ok');
    }

    public function edit(Color $color) {

        return view('backend.color.edit',compact('color'));
    }

    public function update(Color $color, Request $request) {
        
        $validated_data = $this->validated_data($request);

        $if_color_exists = Color::where('name', $request->name)->where('name', '!=', $color->name)->count();

        if($if_color_exists > 0): return back()->with('status', 'error'); endif;
 
        $color->update($validated_data);        

        return back()->with('status','ok');
    }

    public function destroy(Color $color) {
        
        try{
            $color->delete();
            return back()->with('status', 'ok');
        } catch(\Exception $e) {
            return back()->with('status', 'error');
        }
    }

    public function validated_data($request) {
        $data = $request->validate([
            'name' => 'required|min:2|string',
            'lang' => 'required|string'
        ]);

        return $data;
    }

}
