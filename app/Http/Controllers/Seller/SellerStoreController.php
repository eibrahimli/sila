<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SellerStoreController extends Controller
{
  
  public function index() {
    return view('seller.store.index');
  }

  public function create() {
    return view('seller.store.create');
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(),[
      'name' => 'required|min:2|string',
      'surname' => 'required|min:2|string',
      'address' => 'required|min:5',
      'number' => 'required',
      'desc' => 'required|min:5',
      'keyw' => 'required|min:3'
    ]);

    $store = auth()->user()->stores()->create($request->all());

    dd($store);
  }
  
}
