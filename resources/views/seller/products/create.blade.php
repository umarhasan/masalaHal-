@extends('layouts.app')
@section('title','Add Product')

@section('content')
<h3>Add New Product</h3>

<form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Product Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Category</label>
        <select name="category_id" class="form-control" required>
            <option value="">Select Category</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Brand</label>
        <select name="brand_id" class="form-control">
            <option value="">Select Brand</option>
            @foreach($brands as $b)
            <option value="{{ $b->id }}">{{ $b->name }}</option>
            @endforeach
        </select>
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
        <label>Additional Images</label>
        <input type="file" name="images[]" class="form-control" multiple>
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="number" step="0.01" name="price" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Stock</label>
        <input type="number" name="stock" class="form-control" required>
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
        <label>Wholesale?</label>
        <select name="is_wholesale" class="form-control" id="wholesaleSelect">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>

    <div id="wholesaleFields" style="display:none;">
        <div class="mb-3">
            <label>Minimum Quantity</label>
            <input type="number" name="min_qty" class="form-control">
        </div>
        <div class="mb-3">
            <label>Wholesale Price</label>
            <input type="number" step="0.01" name="wholesale_price" class="form-control">
        </div>
    </div>

    <hr>
    <h5>Variants</h5>

    <div class="mb-3">
        <label>Colors</label>
        <input type="text" name="colors[]" class="form-control mb-1" placeholder="Color Name">
        <input type="text" name="colors[]" class="form-control mb-1" placeholder="Color Name">
    </div>

    <div class="mb-3">
        <label>Sizes</label>
        <input type="text" name="sizes[]" class="form-control mb-1" placeholder="Size Name">
        <input type="text" name="sizes[]" class="form-control mb-1" placeholder="Size Name">
    </div>

    <button type="submit" class="btn btn-success">Add Product</button>
</form>

@push('scripts')
<script>
document.getElementById('wholesaleSelect').addEventListener('change', function(){
    document.getElementById('wholesaleFields').style.display = this.value == 1 ? 'block':'none';
});
</script>
@endpush
@endsection
