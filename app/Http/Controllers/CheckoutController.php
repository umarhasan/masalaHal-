<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller {
    public function checkout()
    {
        $cart = (new CartController)->getCart();
        $cart->load('items.product');
        if ($cart->items->isEmpty()) return redirect()->route('shop.index')->with('info','Cart is empty');

        return view('checkout.index', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required',
            'payment_method' => 'required'
        ]);

        $cart = (new CartController)->getCart();
        $cart->load('items.product');

        // calculate totals
        $sub = $cart->items->reduce(fn($s,$i) => $s + ($i->price * $i->quantity), 0);
        $shipping = 0;
        $tax = 0;
        $total = $sub + $shipping + $tax;

        $order = Order::create([
            'user_id' => auth()->id() ?? null,
            'order_number' => 'ORD-'.Str::upper(Str::random(10)),
            'sub_total' => $sub,
            'shipping' => $shipping,
            'tax' => $tax,
            'total' => $total,
            'shipping_address' => $request->shipping_address,
            'billing_address' => $request->billing_address ?? $request->shipping_address,
            'status' => 'pending',
            'meta' => ['payment_method'=> $request->payment_method]
        ]);

        foreach ($cart->items as $i) {
            $order->items()->create([
                'product_id' => $i->product_id,
                'variant_id' => $i->variant_id,
                'quantity' => $i->quantity,
                'unit_price' => $i->price,
                'total' => $i->price * $i->quantity
            ]);

            // decrement stock (basic)
            if ($i->product->stock >= $i->quantity) {
                $i->product->decrement('stock', $i->quantity);
            }
        }

        // clear cart
        $cart->items()->delete();

        // dispatch emails/jobs etc...
        return redirect()->route('orders.show', $order->id)->with('success','Order placed');
    }
}
