<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Get or create cart for logged-in user
    protected function getCart()
    {
        return Cart::firstOrCreate(['user_id' => auth()->id()]);
    }

    // Add product to cart
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant_id' => 'nullable|integer'
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = $this->getCart();
        $price = $product->sale_price ?: $product->price;

        // Handle variant null properly
        $query = $cart->items()->where('product_id', $product->id);
        if ($request->variant_id) {
            $query->where('variant_id', $request->variant_id);
        } else {
            $query->whereNull('variant_id');
        }

        $item = $query->first();

        if ($item) {
            $item->quantity += $request->quantity;
            $item->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'variant_id' => $request->variant_id,
                'quantity' => $request->quantity,
                'price' => $price
            ]);
        }

        $cart->load('items.product');

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'message' => 'Product added to cart',
                'cart' => $cart
            ]);
        }

        return back()->with('success', 'Added to cart');
    }

    // Remove item from cart
    public function remove($id)
    {
        $cart = $this->getCart();
        $item = $cart->items()->findOrFail($id);
        $item->delete();

        return back()->with('success', 'Item removed');
    }

    // Show cart page
    public function index()
    {
        $cart = $this->getCart()->load('items.product.images');
        return view('cart.index', compact('cart'));
    }
}
