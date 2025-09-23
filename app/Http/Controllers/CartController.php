<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    public function show() {

        $carts = Cart::with('product')->where('user_id', auth()->user()->id)->get();
        return response()->json([
            'Message' => 'All products in the cart have been successfully fetched.',
            'Data'    => $carts
        ]);

    }

    public function add(Request $request) {

        $validator = Validator::make($request->all(), [
            'quantity'   => 'required|integer|min:1',
            'product_id' => 'required|integer|exists:products,id',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $product = Product::findOrFail($request->product_id);
        Cart::create([
            'quantity' => $request->quantity,
            'price'    => $product->price * $request->quantity,
            'user_id'  => auth()->user()->id,
            'vendor_id'=> $product->vendor->id,
            'product_id'=> $request->product_id
        ]);

        return response()->json([
            'Message' => 'The product has been successfully added to the cart.'
        ]);

    }

    public function remove(Product $product) {

        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();
        if ($cart) {

            $cart->delete();

        }

        return response()->json([
            'Message' => 'The product has been successfully removed from the cart.'
        ]);

    }
}
