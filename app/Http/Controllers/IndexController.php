<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index() {
      $products = Product::active()->orderByDesc('created_at')->take(18)->get();
      $soldedProducts = Product::active()->orderByDesc('sold')->take(8)->get();
      $seenProducts = Product::active()->orderByDesc('seen')->take(15)->get();
      $sliderproducts = Product::active()->orderByDesc('created_at')->take(3)->get();

      return view('frontend.index',compact('products','soldedProducts', 'seenProducts','sliderproducts'));
    }
}
