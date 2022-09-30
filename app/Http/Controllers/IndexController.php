<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index() {
      $soldedProducts = Product::active()->orderByDesc('sold')->take(8)->get();
      $seenProducts = Product::active()->orderByDesc('seen')->take(15)->get();
      $sliderproducts = Product::active()->orderByDesc('created_at')->take(3)->get();

      // Banner
      $middle = Banner::where('middle', true)->first();

      return view('frontend.index',compact('soldedProducts', 'seenProducts','sliderproducts','middle'));
    }


    public function newProducts() {
      $products = Product::with('category')->active()->orderByDesc('created_at')->paginate(24);

      return response()->json($products);
    }
}
