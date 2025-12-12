@extends('admin.layouts.main')

@section('title','Product Approvals')

@section('main-content')

<div class="section-header">
    <h1>Pending Product Approvals</h1>
</div>

<div class="section-body">

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Seller</th>
                        <th>Price</th>
                        <th style="width: 180px;">Actions</th>
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

            <div class="mt-3">
                {{ $products->links() }}
            </div>

        </div>
    </div>

</div>

@endsection
