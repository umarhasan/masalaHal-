@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Create Product</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary mb-2">Back</a>
    </section>

    <section class="content">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control">
            </div>

            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Brand</label>
                <select name="brand_id" class="form-control">
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Price</label>
                <input type="number" name="price" step="0.01" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Sale Price</label>
                <input type="number" name="sale_price" step="0.01" class="form-control">
            </div>

            <div class="mb-3">
                <label>Stock</label>
                <input type="number" name="stock" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Main Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="mb-3">
                <label>Other Images</label>
                <input type="file" name="images[]" class="form-control" multiple>
            </div>

            <div class="mb-3">
                <label>Colors</label>
                <input type="text" name="colors[]" placeholder="Red, Blue" class="form-control">
            </div>

            <div class="mb-3">
                <label>Sizes</label>
                <input type="text" name="sizes[]" placeholder="S, M, L, XL" class="form-control">
            </div>

            <div class="mb-3">
                <label>Condition</label>
                <select name="condition" class="form-control">
                    <option value="new">New</option>
                    <option value="used">Used</option>
                    <option value="refurbished">Refurbished</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Wholesale</label>
                <input type="checkbox" name="is_wholesale" value="1">
                <input type="number" name="min_qty" placeholder="Min Qty" class="form-control mt-1">
                <input type="number" name="wholesale_price" placeholder="Wholesale Price" step="0.01" class="form-control mt-1">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Admin Approval</label>
                <input type="checkbox" name="is_approved" value="1">
            </div>

            <button class="btn btn-success">Save Product</button>
        </form>
    </section>
</div>
@endsection
