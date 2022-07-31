<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function show(Product $product, $slug) {
      $related_products = $product->category->products->where('id', '!=', $product->id);

      return view('frontend.product.show',compact('product','related_products'));
    }

    public function getProduct(Product $product) {
      $product->spec = unserialize($product->spec);
      $colors = DB::table('colors')->select('colors.name', 'colors.id')->get();

      return response()->json([
        'product' => $product->load('unit'),'stocks' => $product->stocks,
        'colors' => $colors,
        'category_url' => route('category.show', [$product->category->id, Str::slug($product->category->name)]),
        'category' => $product->category->name,
      ],200);
    }

    public function addToCart(Product $product, Request $request) {
      $validator = Validator::make($request->all() , [
        'quantity' => 'required',
        'color' => 'required',
      ]);

      $color = DB::table('colors')->where('id', $request->color)->first();

      if($validator->fails()) {
        return $this->ifValidatorFails($validator);
      }

      try {
        $isExist = Cart::search(function ($cartItem, $rowId) use ($product) {
          return $cartItem->id == $product->id;
        });

        if($isExist->isNotEmpty() ) {
          $data = $isExist->filter(function ($item) use ($request) {
            return $item->options['color'] == $request->color;
          });
          $data = $data->first();
          if($data):
            Cart::update($data->rowId, ['qty' => $request->quantity]);
          else:
            Cart::add($product->id, $product->title, $request->quantity,$product->price,['color' => $request->color,'name' => $color->name ?? 0])
              ->associate(\App\Models\Product::class);
          endif;

        } else {
          Cart::add($product->id, $product->title, $request->quantity,$product->price,['color' => $request->color,'name' => $color->name ?? 0])
            ->associate(\App\Models\Product::class);
        }

        return response()->json(['mes' => 'Səbətə əlavə edildi...'],200);
      } catch (\Exception $e) {
        return response()->json(['mes' => 'Xəta baş verdi...'.$e->getMessage()],422);
      }

    }

    private function ifValidatorFails($validator) {
      return response()->json(['mes' => 'Məhsul məlumatları doğru seçilməyib...'],422);
    }
}
