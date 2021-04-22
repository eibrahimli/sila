<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index() {
      $cart = Cart::content();

      return view('frontend.cart.index',compact('cart'));
    }

    public function getCart() {
      return response()->json(['cart' => Cart::content()]);
    }

    public function store(Request $request) {
      $validator = Validator::make($request->all(), [
        'note' => 'sometimes',
        'name' => 'required|min:2',
        'surname' => 'required|min:2',
        'email' => 'required|email',
        'password' => 'sometimes|min:8',
        'number' => 'required',
        'city' => 'required',
        'adress' => 'required',
      ]);

      $cart = serialize(Cart::content());

      $items = Cart::content();
      $total_quantity = 0;
      $total_price = 0;
      foreach ($items as $item):
        $total_quantity += $item->qty;
        $total_price += (float) $item->subtotal;
      endforeach;

      $total_price = number_format((float)$total_price, 2, '.', '');

      if($validator->fails()) {
        return response()->json(['mes' => 'Lazım olan məlumatlar yanlışdır..'],422);
      }

      if(auth()->check()):
        try{
          $data = $validator->validated();

          $data['cart'] = $cart;
          $data['total_quantity'] = $total_quantity;
          $data['total_price'] = $total_price;


          $order = auth()->user()->orders()->create($data);
          Cart::destroy();
          return response()->json(['mes' => 'Uğurla sifariş etdiniz..','order' => $order],200);
        } catch (\Exception $e) {
          return response()->json(['mes' => 'Lazım olan məlumatlar yanlışdır..'.$e->getMessage()],422);
        }
      else:
        if($request->has('login')):
          if($request->login):
            $data = $validator->validated();
            array_shift($data);
            $data['password'] = Hash::make($data['password']);

            $data['cart'] = $cart;
            $data['total_quantity'] = $total_quantity;
            $data['total_price'] = $total_price;

            $user = User::create($data);

            $order = $user->orders()->create($validator->validated());
            Cart::destroy();
            return response()->json(['mes' => 'Uğurla sifariş etdiniz..','order' => $order],200);
          else:
            $data = $validator->validated();
            $data['cart'] = $cart;
            $data['total_quantity'] = $total_quantity;
            $data['total_price'] = $total_price;

            $order = Order::create($data);
            Cart::destroy();
            return response()->json(['mes' => 'Uğurla sifariş etdiniz..','order' => $order],200);
          endif;
        endif;
      endif;
    }

    public function update($rowId, Request $request) {

      $validator = Validator::make($request->all(), [
        'quantity' => 'required',
      ]);

      if($validator->fails()) {
        return response()->json(['mes' => 'Məhsul miqdarı doğru deil'],422);
      }

      $cart = Cart::content();
      $ifRowIdExists = $cart->search(function($item) use($rowId) {
        return $item->rowId == $rowId;
      });

      try{

        if($ifRowIdExists):
          Cart::update($request->rowId,$request->quantity);

          return response()->json(['status' => 'ok','cart' => Cart::content()],200);
        else:
          return response()->json(['mes' => 'Məhsul miqdarı doğru deil'],422);
        endif;

      } catch (\Exception $e) {
        return response()->json(['mes' => 'Məhsulun miqdarını dəyişmək mümkün olmadı...'],422);
      }
    }

    public function delete($rowId) {
        $cart = Cart::content();
        $ifRowIdExists = $cart->search(function($item) use($rowId) {
          return $item->rowId == $rowId;
        });

        if($ifRowIdExists) {
          Cart::remove($rowId);
          return response()->json(['mes' => 'Uğurla silindi...', 'cart' => Cart::content()],200);
        }

        return response()->json(['mes' => 'Seçdiyiniz məhsul səbətdə tapılmadı'],422);
    }

    public function checkout() {
      if(count(Cart::content()) == 0) return redirect()->route('cart.index');
      return view('frontend.cart.checkout');
    }

}
