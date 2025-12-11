@extends('layouts.app')
@section('title','My Products')

@section('content')
<h3>My Products</h3>
<a href="{{ route('seller.products.create') }}" class="btn btn-primary mb-3">Add Product</a>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Approved</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $p)
        <tr>
            <td>{{ $p->name }}</td>
            <td>${{ $p->price }}</td>
            <td>{{ $p->is_approved ? 'Yes' : 'Pending' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
