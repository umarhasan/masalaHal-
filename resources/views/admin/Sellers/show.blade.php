@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Seller Details</h1>
        <a href="{{ route('sellers.index') }}" class="btn btn-secondary mb-2">Back</a>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <strong>User Name:</strong> {{ $seller->user->name }} <br>
                <strong>Email:</strong> {{ $seller->user->email }} <br>
                <strong>Store Name:</strong> {{ $seller->store_name }} <br>
                <strong>Slug:</strong> {{ $seller->slug }} <br>
                <strong>Bio:</strong> {!! nl2br($seller->bio) !!} <br>
                <strong>Logo:</strong>
                @if($seller->logo)
                    <img src="{{ asset('uploads/sellers/'.$seller->logo) }}" width="100" class="mt-2">
                @endif
                <br>
                <strong>Verified:</strong> {{ $seller->is_verified ? 'Yes' : 'No' }} <br>

                <h4 class="mt-3">Products</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Approval</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($seller->products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
                            <td>{{ $product->is_approved ? 'Approved' : 'Pending' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
