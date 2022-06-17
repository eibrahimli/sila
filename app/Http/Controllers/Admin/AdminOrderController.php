<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\OrderActivatedJob;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminOrderController extends Controller
{
    public function index() {
      $total_prices = Order::where('active', 1)->sum('total_price');

      return view('backend.order.index',compact('total_prices'));
    }

    public function notActiveIndex() {
      $total_prices = Order::where('active', 0)->sum('total_price');

      return view('backend.order.not-active-index',compact('total_prices'));
    }

    public function show(Order $order) {
      // dd(unserialize($order->cart));
      return view('backend.order.show')->with('order', $order);
    }

    public function getNotActiveOrders() {
      $orders = Order::where('active', 0)->orderByDesc('id')->paginate(10);

      return response()->json(['orders' => $orders],200);
    }

    public function getActiveOrders() {
      $orders = Order::where('active', 1)->orderByDesc('id')->paginate(10);

      return response()->json(['orders' => $orders],200);
    }

    public function activeOrder(Order $order, Request $request) {

      if($order):
        $order->update(['active' => 1]);

        $orders = Order::where('active', 0)->orderByDesc('id')->paginate(10);

        OrderActivatedJob::dispatch($order);

        return response()->json(['mes' => 'Uğurlu şəkildə aktiv edildi.Alıcının email hesabına mail göndərildi','orders' => $orders],200);
      else:
        return response()->json(['mes' => 'Sifariş aktiv edilərkən xəta baş verdi..'],422);
      endif;
    }

    public function destroy(Order $order) {
      if($order):
        $order->delete();
        $orders = Order::where('active', 0)->orderByDesc('id')->paginate(10);
        return response()->json(['mes' => 'Uğurlu şəkildə silindi..','orders' => $orders],200);
      else:
        return response()->json(['mes' => 'Sifariş silinərkən xəta baş verdi..'],422);
      endif;
    }
    public function activeDestroy(Order $order) {
      if($order):
        $order->delete();
        $orders = Order::where('active', 1)->orderByDesc('id')->paginate(10);
        return response()->json(['mes' => 'Uğurlu şəkildə silindi..','orders' => $orders],200);
      else:
        return response()->json(['mes' => 'Sifariş silinərkən xəta baş verdi..'],422);
      endif;
    }
}
