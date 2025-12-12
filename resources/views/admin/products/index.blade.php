@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="m-0">Products</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Add New
            </a>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Product List</h3>
            </div>

            <div class="card-body table-responsive p-0">

                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Seller</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Approved</th>
                            <th>Wholesale</th>
                            <th class="text-center" width="220">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->user ? $product->user->name : 'Admin' }}</td>
                                <td>{{ number_format($product->price) }}</td>
                                <td>
                                    <span class="badge bg-{{ $product->status ? 'success' : 'secondary' }}">
                                        {{ $product->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-{{ $product->is_approved ? 'success' : 'warning' }}">
                                        {{ $product->is_approved ? 'Approved' : 'Pending' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-{{ $product->is_wholesale ? 'info' : 'light' }}">
                                        {{ $product->is_wholesale ? 'Yes' : 'No' }}
                                    </span>
                                </td>

                                <td class="text-center">

                                    <a href="{{ route('products.show', $product->id) }}"
                                       class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{ route('products.destroy', $product->id) }}"
                                          method="POST"
                                          class="d-inline-block"
                                          onsubmit="return confirm('Are you sure?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                    @if(!$product->is_approved)
                                        <form action="{{ route('products.approve', $product->id) }}"
                                              method="POST"
                                              class="d-inline-block">

                                            @csrf
                                            <button class="btn btn-success btn-sm">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </form>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>

    </section>
</div>
@endsection
