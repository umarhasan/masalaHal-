@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Sellers</h1>
    </section>

    <section class="content">
        <a href="{{ route('sellers.create') }}" class="btn btn-success mb-2">New Seller</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Store Name</th>
                    <th>User</th>
                    <th>Verified</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sellers as $seller)
                <tr>
                    <td>{{ $seller->id }}</td>
                    <td>{{ $seller->store_name }}</td>
                    <td>{{ $seller->user->name ?? '' }}</td>
                    <td>{{ $seller->is_verified ? 'Yes' : 'No' }}</td>
                    <td>
                        <form action="{{ route('sellers.verify', $seller->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success btn-sm">{{ $seller->is_verified ? 'Unverify' : 'Verify' }}</button>
                        </form>
                        <a href="{{ route('sellers.edit', $seller->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('sellers.destroy', $seller->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
@endsection
