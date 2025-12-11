@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Product Details</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary mb-2">Back</a>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <strong>Name:</strong> {{ $product->name }} <br>
                <strong>Slug:</strong> {{ $product->slug }} <br>
                <strong>Category:</strong> {{ $product->category ? $product->category->name : '-' }} <br>
                <strong>Brand:</strong> {{ $product->brand ? $product->brand->name : '-' }} <br>
                <strong>Price:</strong> {{ $product->price }} <br>
                <strong>Sale Price:</strong> {{ $product->sale_price }} <br>
                <strong>Stock:</strong> {{ $product->stock }} <br>
                <strong>Status:</strong> {{ $product->status ? 'Active' : 'Inactive' }} <br>
                <strong>Condition:</strong> {{ ucfirst($product->condition) }} <br>
                <strong>Wholesale:</strong> {{ $product->is_wholesale ? 'Yes' : 'No' }} <br>
                <strong>Min Qty:</strong> {{ $product->min_qty }} <br>
                <strong>Wholesale Price:</strong> {{ $product->wholesale_price }} <br>
                <strong>Admin Approval:</strong> {{ $product->is_approved ? 'Yes' : 'No' }} <br>
                <strong>Description:</strong> {!! nl2br($product->description) !!} <br>
                <strong>Main Image:</strong>
                @if($product->image)
                    <img src="{{ asset('uploads/products/'.$product->image) }}" width="100" class="mt-2">
                @endif
                <br>
                <strong>Other Images:</strong>
                @foreach($product->images as $img)
                    <img src="{{ asset('uploads/products/'.$img->image) }}" width="60" class="mt-2">
                @endforeach
                <br>
                <strong>Colors:</strong> {{ $product->colors->pluck('color_name')->join(', ') }} <br>
                <strong>Sizes:</strong> {{ $product->sizes->pluck('size')->join(', ') }} <br>
            </div>
        </div>
    </section>
</div>
@endsection
