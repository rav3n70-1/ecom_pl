<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        
        // Check if any cart items have missing products
        $invalidItems = $cartItems->filter(function($item) {
            return $item->product === null;
        });
        
        if ($invalidItems->isNotEmpty()) {
            // Remove invalid items from cart
            $invalidItems->each(function($item) {
                $item->delete();
            });
            
            return redirect()->route('cart.index')->with('warning', 'Some items in your cart are no longer available and have been removed.');
        }
        
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        
        $shipping = $subtotal >= 50 ? 0 : 9.99;
        $tax = $subtotal * 0.08;
        $total = $subtotal + $shipping + $tax;
        
        return view('checkout.index', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    /**
     * Process the checkout.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'payment_method' => 'sometimes|in:credit_card,paypal,cash_on_delivery',
        ]);
        
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        
        // Validate that all products still exist and are available
        foreach ($cartItems as $item) {
            if (!$item->product) {
                return redirect()->route('cart.index')->with('error', 'Some items in your cart are no longer available.');
            }
        }
        
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        
        $shipping = $subtotal >= 50 ? 0 : 9.99;
        $tax = $subtotal * 0.08;
        $total = $subtotal + $shipping + $tax;
        
        try {
            DB::transaction(function () use ($request, $user, $cartItems, $total) {
                // Create order
                $order = Order::create([
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip_code' => $request->zip_code,
                    'total' => $total,
                    'status' => 'pending',
                ]);
                
                // Create order items
                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                    ]);
                }
                
                // Clear cart
                Cart::where('user_id', $user->id)->delete();
            });
            
            return redirect()->route('checkout.success')->with('success', 'Order placed successfully!');
            
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'There was an error processing your order. Please try again.');
        }
    }

    /**
     * Display the success page.
     */
    public function success()
    {
        return view('checkout.success');
    }
}
