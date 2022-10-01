<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function show(Store $store) {
        return view('frontend.store.index', compact('store'));
    }
}
