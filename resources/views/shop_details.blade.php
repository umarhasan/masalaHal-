@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <img src="{{ asset('uploads/products/'.$product->image) }}" class="img-fluid">
      @foreach($product->images as $img)
        <img src="{{ asset('uploads/products/gallery/'.$img->image) }}" style="width:80px;">
      @endforeach
    </div>
    <div class="col-md-6">
      <h3>{{ $product->name }}</h3>
      <p>Rs. {{ $product->sale_price ?? $product->price }}</p>
      <p>Condition: {{ ucfirst($product->condition) }}</p>

      <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="mb-2">
          <label>Quantity</label>
          <input type="number" name="quantity" value="1" min="1" class="form-control" style="width:120px;">
        </div>
        <button class="btn btn-primary">Add to Cart</button>
      </form>
    </div>
  </div>
</div>
@endsection
