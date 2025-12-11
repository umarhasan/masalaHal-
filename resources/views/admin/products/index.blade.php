@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-success mb-2">New Product</a>
    </section>

    <section class="content">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Seller</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Approved</th>
                    <th>Wholesale</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->user ? $product->user->name : 'Admin' }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $product->is_approved ? 'Yes' : 'No' }}</td>
                        <td>{{ $product->is_wholesale ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>

                            @if(!$product->is_approved)
                                <form action="{{ route('products.approve', $product->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Approve</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
@endsection
