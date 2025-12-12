<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    // Require auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show checkout page
    public function checkout()
    {
        $cart = auth()->user()->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('shop.index')->with('info', 'Cart is empty');
        }

        return view('checkout.index', compact('cart'));
    }

    // Place order
    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required',
            'payment_method' => 'required'
        ]);

        $cart = auth()->user()->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('shop.index')->with('info', 'Cart is empty');
        }

        // Calculate totals
        $sub = $cart->items->sum(fn($i) => $i->price * $i->quantity);
        $shipping = 0;
        $tax = 0;
        $total = $sub + $shipping + $tax;

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . Str::upper(Str::random(10)),
            'sub_total' => $sub,
            'shipping' => $shipping,
            'tax' => $tax,
            'total' => $total,
            'shipping_address' => $request->shipping_address,
            'billing_address' => $request->billing_address ?? $request->shipping_address,
            'status' => 'pending',
            'meta' => ['payment_method' => $request->payment_method]
        ]);

        foreach ($cart->items as $i) {
            $order->items()->create([
                'product_id' => $i->product_id,
                'variant_id' => $i->variant_id,
                'quantity' => $i->quantity,
                'unit_price' => $i->price,
                'total' => $i->price * $i->quantity
            ]);

            // Decrement stock
            if ($i->product->stock >= $i->quantity) {
                $i->product->decrement('stock', $i->quantity);
            }
        }

        // Clear cart
        $cart->items()->delete();

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully');
    }
}
