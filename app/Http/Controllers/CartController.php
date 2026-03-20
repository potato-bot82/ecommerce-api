<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;


class CartController extends Controller
{
        public function add(Request $request)
    {
        $user = auth()->user();

        $cart = Cart::firstOrCreate([
            'user_id' => $user->id
        ]);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($item) {
            $item->increment('quantity', $request->quantity);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        return response()->json(['message' => 'Added to cart']);
    }

     public function index()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', auth()->id())
            ->first();

        return response()->json($cart);
    }

        public function remove($id)
    {
        CartItem::findOrFail($id)->delete();

        return response()->json(['message' => 'Item removed']);
    }
}
