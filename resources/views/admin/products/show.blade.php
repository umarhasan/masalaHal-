@extends('admin.layouts.main')

@section('main-content')

<div class="section-header">
    <h1>Product Details</h1>
    <div class="section-header-button">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="section-body">

    <div class="card">
        <div class="card-body">

            <p><strong>Name:</strong> {{ $product->name }}</p>
            <p><strong>Slug:</strong> {{ $product->slug }}</p>
            <p><strong>Category:</strong> {{ $product->category ? $product->category->name : '-' }}</p>
            <p><strong>Brand:</strong> {{ $product->brand ? $product->brand->name : '-' }}</p>
            <p><strong>Price:</strong> {{ $product->price }}</p>
            <p><strong>Sale Price:</strong> {{ $product->sale_price }}</p>
            <p><strong>Stock:</strong> {{ $product->stock }}</p>
            <p><strong>Status:</strong> {{ $product->status ? 'Active' : 'Inactive' }}</p>
            <p><strong>Condition:</strong> {{ ucfirst($product->condition) }}</p>
            <p><strong>Wholesale:</strong> {{ $product->is_wholesale ? 'Yes' : 'No' }}</p>
            <p><strong>Min Qty:</strong> {{ $product->min_qty }}</p>
            <p><strong>Wholesale Price:</strong> {{ $product->wholesale_price }}</p>
            <p><strong>Admin Approval:</strong> {{ $product->is_approved ? 'Yes' : 'No' }}</p>

            <p><strong>Description:</strong><br> {!! nl2br($product->description) !!}</p>

            <p><strong>Main Image:</strong><br>
                @if($product->image)
                    <img src="{{ asset('uploads/products/'.$product->image) }}" width="100" class="mt-2">
                @endif
            </p>

            <p><strong>Other Images:</strong><br>
                @foreach($product->images as $img)
                    <img src="{{ asset('uploads/products/'.$img->image) }}" width="60" class="mt-2">
                @endforeach
            </p>

            <p><strong>Colors:</strong> {{ $product->colors->pluck('color_name')->join(', ') }}</p>
            <p><strong>Sizes:</strong> {{ $product->sizes->pluck('size')->join(', ') }}</p>

        </div>
    </div>

</div>

@endsection
