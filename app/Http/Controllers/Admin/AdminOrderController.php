<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index() {
      $orders = Order::where('active', 1)->orderByDesc('id')->paginate(1);

      return view('backend.order.index',compact('orders'));
    }
}
