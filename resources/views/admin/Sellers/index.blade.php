@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Sellers</h1>
        <a href="{{ route('sellers.create') }}" class="btn btn-success mb-2">Add Seller</a>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Store Name</th>
                            <th>Verified</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sellers as $seller)
                        <tr>
                            <td>{{ $seller->id }}</td>
                            <td>{{ $seller->user->name }}</td>
                            <td>{{ $seller->store_name }}</td>
                            <td>{{ $seller->is_verified ? 'Yes' : 'No' }}</td>
                            <td>
                                <a href="{{ route('sellers.show', $seller->id) }}" class="btn btn-info btn-sm">Show</a>
                                <a href="{{ route('sellers.edit', $seller->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                <form action="{{ route('sellers.destroy', $seller->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>

                                @if(!$seller->is_verified)
                                    <form action="{{ route('sellers.verify', $seller->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        <button class="btn btn-success btn-sm">Verify</button>
                                    </form>
                                @else
                                    <form action="{{ route('sellers.unverify', $seller->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        <button class="btn btn-warning btn-sm">Unverify</button>
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
