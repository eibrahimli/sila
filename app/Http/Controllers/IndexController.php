<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
      $products = Product::where('status', '1')->take(18)->get();
      $soldedProducts = Product::where('status', '1')->orderByDesc('sold')->take(8)->get();
      $seenProducts = Product::where('status', '1')->orderByDesc('seen')->take(15)->get();

      return view('frontend.index',compact('products','soldedProducts', 'seenProducts'));
    }
}
