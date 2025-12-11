@extends('admin.layouts.app')
@section('title','Product Approvals')

@section('content')
<h3>Pending Product Approvals</h3>

<table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Seller</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $p)
        <tr>
            <td>{{ $p->name }}</td>
            <td>{{ $p->seller->store_name ?? $p->user->name }}</td>
            <td>${{ $p->price }}</td>
            <td>
                <form action="{{ route('products.approve',$p->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-success btn-sm">Approve</button>
                </form>
                <form action="{{ route('products.reject',$p->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-danger btn-sm">Reject</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $products->links() }}
@endsection
