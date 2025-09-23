<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\OrderVendor;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function getUserOrders() {

        $orders = Order::with('orderVendors.orderDetails.product')->where('user_id', auth()->user()->id)->get();
        return response()->json([
            'Message' => 'Fetch All Orders Suc',
            'Data' => $orders
        ]);

    }

    public function getVendorOrders(Vendor $vendor) {

        $orders = OrderVendor::with('orderDetails.product')->where('vendor_id', $vendor->id)->get();
        return response()->json([
            'Message' => 'Fetch All Orders Suc',
            'Data' => $orders
        ]);

    }

    public function create() {

        $carts = Cart::where('user_id', auth()->user()->id)->get();
        $order = Order::create([
            'user_id'    => auth()->user()->id
        ]);

        foreach($carts as $cart) {

            $orderVendor = OrderVendor::where('vendor_id', $cart->product->vendor_id)
                                        ->where('user_id', $cart->user_id)
                                        ->where('order_id', $order->id)
                                        ->first();
            if(!$orderVendor) {

                $orderVendor = OrderVendor::create([
                    'vendor_id' => $cart->product->vendor_id,
                    'order_id'  => $order->id,
                    'user_id'   => $cart->user_id
                ]);

                OrderDetail::create([
                    'product_id' => $cart->product_id,
                    'quantity'   => $cart->quantity,
                    'price'      => $cart->price,
                    'order_vendor_id' => $orderVendor->id
                ]);
                $orderVendor->increment('totalPrice', $cart->price);

            } else {

                OrderDetail::create([
                    'product_id' => $cart->product_id,
                    'quantity'   => $cart->quantity,
                    'price'      => $cart->price,
                    'order_vendor_id' => $orderVendor->id
                ]);
                $orderVendor->increment('totalPrice', $cart->price);

            }

            $cart->delete();
        }

        $totalOrderPrice = OrderVendor::where('user_id', $cart->user_id)
                                        ->where('order_id', $order->id)
                                        ->sum('totalPrice');
        $order->increment('totalPrice', $totalOrderPrice);

        return response()->json([
            'Message' => 'Order Created Suc'
        ]);
    }
}
