<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(Category $category,$slug)
    {
        return view('frontend.category.show',compact('category'));
    }

    public function edit(Category $category)
    {
        //
    }

    public function getCategory(Category $category) {
      $products = $category->products()->paginate(2);
      $recent_products = Product::where('status', '1')->take(5)->get();
      return response()->json(['products' => $products, 'category' => $category, 'recent_products' => $recent_products]);
    }

    public function sortingCategoryProduct(Category $category,Request $request) {

      $products = $category->products()->withFilters($request->brands,$request->colors,$request->min,$request->max)->paginate(2);

      return response()->json(['products' => $products],200);
    }

    public function update(Request $request, Category $category)
    {
        //
    }


    public function destroy(Category $category)
    {
        //
    }
}
