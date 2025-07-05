<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate; // Import the Gate facade

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        // Eager load the product details to avoid N+1 issues
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        // Calculate the total price
        $total = $cartItems->reduce(function ($carry, $item) {
            // Ensure product and price are not null
            if ($item->product && $item->product->price) {
                return $carry + ($item->product->price * $item->quantity);
            }
            return $carry;
        }, 0);

        return view('cart.index', ['cartItems' => $cartItems, 'total' => $total]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);

        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('products.show', ['product' => $product])->with('success', 'Product added to cart successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Cart $cart)
    {
        // Ensure the authenticated user owns the cart item
        if (Gate::denies('update', $cart)) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Cart $cart)
    {
        // Ensure the authenticated user owns the cart item
        if (Gate::denies('delete', $cart)) {
            abort(403);
        }

        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
    }
}
