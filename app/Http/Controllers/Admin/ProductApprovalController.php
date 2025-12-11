<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApprovalController extends Controller {
    public function index() {
        $products = Product::with('seller','category')->where('is_approved',0)->latest()->paginate(20);
        return view('admin.products.approvals', compact('products'));
    }

    public function approve($id) {
        $product = Product::findOrFail($id);
        $product->update(['is_approved' => 1]);
        return back()->with('success','Product approved');
    }

    public function reject(Request $request, $id) {
        $product = Product::findOrFail($id);
        // optional: notify seller reason
        $product->delete();
        return back()->with('success','Product rejected and removed');
    }
}
