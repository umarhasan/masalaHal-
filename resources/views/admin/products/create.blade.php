@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1>Create Product</h1>
                </div>
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="content">
        <div class="container-fluid">

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Some errors occurred.<br><br>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary mb-2">Back</a>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Slug</label>
                                        <input type="text" name="slug" class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Category</label>
                                        <select name="category_id" class="form-control">
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Brand</label>
                                        <select name="brand_id" class="form-control">
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Price</label>
                                        <input type="number" name="price" step="0.01" class="form-control" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Sale Price</label>
                                        <input type="number" name="sale_price" step="0.01" class="form-control">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Stock</label>
                                        <input type="number" name="stock" class="form-control" required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Main Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Other Images</label>
                                        <input type="file" name="images[]" class="form-control" multiple>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Colors (comma separated)</label>
                                        <input type="text" name="colors[]" class="form-control" placeholder="Red, Blue">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Sizes (comma separated)</label>
                                        <input type="text" name="sizes[]" class="form-control" placeholder="S, M, L, XL">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Condition</label>
                                        <select name="condition" class="form-control">
                                            <option value="new">New</option>
                                            <option value="used">Used</option>
                                            <option value="refurbished">Refurbished</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Wholesale</label>
                                        <div>
                                            <input type="checkbox" name="is_wholesale" value="1"> Enable
                                            <input type="number" name="min_qty" class="form-control mt-2" placeholder="Min Qty">
                                            <input type="number" name="wholesale_price" class="form-control mt-2" placeholder="Wholesale Price" step="0.01">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Admin Approval</label><br>
                                        <input type="checkbox" name="is_approved" value="1"> Approve Now
                                    </div>

                                </div>

                                <button class="btn btn-success mt-2">Save Product</button>

                            </form>

                        </div>
                    </div> <!-- card end -->

                </div>
            </div>

        </div>
    </section>

</div>
@endsection
