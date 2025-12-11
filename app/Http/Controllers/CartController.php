<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    protected function getCart()
    {
        if (auth()->check()) {
            return Cart::firstOrCreate(['user_id' => auth()->id()]);
        }
        $sessionId = session()->get('cart_session', Str::random(40));
        session()->put('cart_session', $sessionId);
        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }

    public function add(Request $request)
    {
        $request->validate(['product_id'=>'required|exists:products,id','quantity'=>'required|integer|min:1','variant_id'=>'nullable|integer']);
        $product = Product::findOrFail($request->product_id);
        $cart = $this->getCart();

        $price = $product->sale_price ?: $product->price;

        $item = $cart->items()->where('product_id',$product->id)->where('variant_id',$request->variant_id)->first();
        if ($item) {
            $item->quantity += $request->quantity;
            $item->save();
        } else {
            $cart->items()->create([
                'product_id'=>$product->id,
                'variant_id'=>$request->variant_id,
                'quantity'=>$request->quantity,
                'price'=>$price
            ]);
        }

        return back()->with('success','Added to cart');
    }

    public function remove($id)
    {
        $cart = $this->getCart();
        $item = $cart->items()->findOrFail($id);
        $item->delete();
        return back()->with('success','Item removed');
    }

    public function index()
    {
        $cart = $this->getCart();
        $cart->load('items.product.images');
        return view('cart.index', compact('cart'));
    }
}
