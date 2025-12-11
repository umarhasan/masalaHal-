<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SellerProductController extends Controller
{
    public function index() {
        $products = Product::where('user_id',auth()->id())->paginate(20);
        return view('seller.products.index', compact('products'));
    }

    public function create() {
        return view('seller.products.create',[
            'categories'=>Category::all(),
            'brands'=>Brand::all()
        ]);
    }

    public function store(Request $req){
        $req->validate(['name'=>'required','price'=>'required']);

        Product::create([
            'user_id'=>auth()->id(),
            'name'=>$req->name,
            'slug'=>Str::slug($req->name).'-'.uniqid(),
            'category_id'=>$req->category_id,
            'brand_id'=>$req->brand_id,
            'price'=>$req->price,
            'sale_price'=>$req->sale_price,
            'is_approved'=>0
        ]);

        return back()->with('success','Product submitted for approval');
    }
}
