@extends('layouts.app')
@section('title','Edit Product')

@section('content')
<h3>Edit Product</h3>

<form action="{{ route('seller.products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Product Name</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
    </div>

    <div class="mb-3">
        <label>Category</label>
        <select name="category_id" class="form-control" required>
            <option value="">Select Category</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @if($product->category_id==$cat->id) selected @endif>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Brand</label>
        <select name="brand_id" class="form-control">
            <option value="">Select Brand</option>
            @foreach($brands as $b)
            <option value="{{ $b->id }}" @if($product->brand_id==$b->id) selected @endif>{{ $b->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Main Image</label>
        <input type="file" name="image" class="form-control">
        @if($product->image)
        <img src="{{ asset('uploads/products/'.$product->image) }}" width="80">
        @endif
    </div>

    <div class="mb-3">
        <label>Additional Images</label>
        <input type="file" name="images[]" class="form-control" multiple>
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
    </div>

    <div class="mb-3">
        <label>Stock</label>
        <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
    </div>

    <div class="mb-3">
        <label>Condition</label>
        <select name="condition" class="form-control">
            <option value="new" @if($product->condition=='new') selected @endif>New</option>
            <option value="used" @if($product->condition=='used') selected @endif>Used</option>
            <option value="refurbished" @if($product->condition=='refurbished') selected @endif>Refurbished</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Wholesale?</label>
        <select name="is_wholesale" class="form-control" id="wholesaleSelect">
            <option value="0" @if(!$product->is_wholesale) selected @endif>No</option>
            <option value="1" @if($product->is_wholesale) selected @endif>Yes</option>
        </select>
    </div>

    <div id="wholesaleFields" style="display: {{ $product->is_wholesale ? 'block':'none' }}">
        <div class="mb-3">
            <label>Minimum Quantity</label>
            <input type="number" name="min_qty" class="form-control" value="{{ $product->min_qty }}">
        </div>
        <div class="mb-3">
            <label>Wholesale Price</label>
            <input type="number" step="0.01" name="wholesale_price" class="form-control" value="{{ $product->wholesale_price }}">
        </div>
    </div>

    <hr>
    <h5>Variants</h5>

    <div class="mb-3">
        <label>Colors</label>
        @foreach($product->colors as $color)
        <input type="text" name="colors[]" class="form-control mb-1" value="{{ $color->color_name }}">
        @endforeach
        <input type="text" name="colors[]" class="form-control mb-1" placeholder="Add New Color">
    </div>

    <div class="mb-3">
        <label>Sizes</label>
        @foreach($product->sizes as $size)
        <input type="text" name="sizes[]" class="form-control mb-1" value="{{ $size->size }}">
        @endforeach
        <input type="text" name="sizes[]" class="form-control mb-1" placeholder="Add New Size">
    </div>

    <button type="submit" class="btn btn-success">Update Product</button>
</form>

@push('scripts')
<script>
document.getElementById('wholesaleSelect').addEventListener('change', function(){
    document.getElementById('wholesaleFields').style.display = this.value == 1 ? 'block':'none';
});
</script>
@endpush
@endsection
