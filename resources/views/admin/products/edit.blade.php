@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Product</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary mb-2">Back</a>
    </section>

    <section class="content">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ $product->slug }}">
            </div>

            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @if($product->category_id == $cat->id) selected @endif>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Brand</label>
                <select name="brand_id" class="form-control">
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" @if($product->brand_id == $brand->id) selected @endif>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Price</label>
                <input type="number" name="price" step="0.01" class="form-control" value="{{ $product->price }}" required>
            </div>

            <div class="mb-3">
                <label>Sale Price</label>
                <input type="number" name="sale_price" step="0.01" class="form-control" value="{{ $product->sale_price }}">
            </div>

            <div class="mb-3">
                <label>Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            </div>

            <div class="mb-3">
                <label>Main Image</label>
                <input type="file" name="image" class="form-control">
                @if($product->image)
                    <img src="{{ asset('uploads/products/'.$product->image) }}" width="60" class="mt-2">
                @endif
            </div>

            <div class="mb-3">
                <label>Other Images</label>
                <input type="file" name="images[]" class="form-control" multiple>
            </div>

            <div class="mb-3">
                <label>Colors (comma separated)</label>
                <input type="text" name="colors[]" value="{{ implode(',', $product->colors->pluck('color_name')->toArray()) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Sizes (comma separated)</label>
                <input type="text" name="sizes[]" value="{{ implode(',', $product->sizes->pluck('size')->toArray()) }}" class="form-control">
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
                <label>Wholesale</label>
                <input type="checkbox" name="is_wholesale" value="1" @if($product->is_wholesale) checked @endif>
                <input type="number" name="min_qty" placeholder="Min Qty" value="{{ $product->min_qty }}" class="form-control mt-1">
                <input type="number" name="wholesale_price" placeholder="Wholesale Price" step="0.01" value="{{ $product->wholesale_price }}" class="form-control mt-1">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" @if($product->status) selected @endif>Active</option>
                    <option value="0" @if(!$product->status) selected @endif>Inactive</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Admin Approval</label>
                <input type="checkbox" name="is_approved" value="1" @if($product->is_approved) checked @endif>
            </div>

            <button class="btn btn-success">Update Product</button>
        </form>
    </section>
</div>
@endsection
