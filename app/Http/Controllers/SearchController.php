<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Product;
use Arr;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;

class SearchController extends Controller
{
    public function entry(SearchRequest $request) {
        $data = $request->validated();

        $products = Product::query();

        if(Arr::exists($data,'category_id') && $data['category_id'] !== 'all'):
            $products->where('category_id', $data['category_id']);
        endif;  

        $products->where('title', 'like', '%'. $data['query'] .'%');

        return view('frontend.search.results')->with('products', $products->get());
    }
}
