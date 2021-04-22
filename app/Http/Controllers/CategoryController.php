<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
      $products = $category->products()->orderByDesc('id')->paginate(20);
      $recent_products = Product::where('status', '1')->take(5)->get();
      return response()->json(['products' => $products, 'category' => $category, 'recent_products' => $recent_products]);
    }

    public function sortingCategoryProduct(Category $category,Request $request) {

      $products = $category->products()
        ->where('status', '1')
        ->withFilters($request->brands,$request->colors,$request->min,$request->max,$request->sort)
        ->paginate(20);

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
