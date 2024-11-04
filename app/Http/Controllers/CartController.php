<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $items = CartItem::where('user_id', Auth::id())->get();
        return view('cart.index', compact('CartItems'));
    }
    public function addtoCart(Request $request, $product_id)
    {
        $cartItem = CartItem::where('user_id', Auth::id())->where('product_id', $product_id)->first();
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            $cartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'quantity' => 1
            ]);
        }
        return redirect(route('cart.index'));
    }
}
