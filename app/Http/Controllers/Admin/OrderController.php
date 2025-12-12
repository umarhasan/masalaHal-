<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(30);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user','items.product','items.variant'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status'=>'required|in:pending,processing,shipped,delivered,cancelled,refunded']);
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        // optionally notify user, seller payouts etc.

        return redirect()->back()->with('success','Order status updated.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->items()->delete();
        $order->delete();
        return redirect()->route('orders.index')->with('success','Order removed.');
    }
}
