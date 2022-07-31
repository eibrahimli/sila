<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index() {
        $units = Unit::all()->sortByDesc('id');

        return view('backend.unit.index',compact('units'));
    }

    public function create() {

        return view('backend.unit.create');
    }

    public function store(Request $request) {
        
        $validated_data = $this->validated_data($request);

        $if_unit_exists = Unit::where('name', $request->name)->count();

        if($if_unit_exists > 0): return back()->with('status', 'error'); endif;
 
        Unit::create($validated_data);        

        return back()->with('status','ok');
    }

    public function edit(Unit $unit) {

        return view('backend.unit.edit',compact('unit'));
    }

    public function update(Unit $unit, Request $request) {
        
        $validated_data = $this->validated_data($request);

        $if_unit = Unit::where('name', $request->name)->where('name', '!=', $unit->name)->count();

        if($if_unit > 0): return back()->with('status', 'error'); endif;
 
        $unit->update($validated_data);        

        return back()->with('status','ok');
    }

    public function destroy(Unit $unit) {
        
        try{
            $unit->delete();
            return back()->with('status', 'ok');
        } catch(\Exception $e) {
            return back()->with('status', 'error');
        }
    }

    public function validated_data($request) {
        $data = $request->validate([
            'name' => 'required|min:2|string'
        ]);

        return $data;
    }
    
}
