@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Banners</h1>
        <a href="{{ route('banners.create') }}" class="btn btn-success mb-2">Add New Banner</a>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td>{{ $banner->title }}</td>
                            <td>
                                @if($banner->image)
                                <img src="{{ asset('uploads/banners/'.$banner->image) }}" width="80">
                                @endif
                            </td>
                            <td>{{ $banner->link }}</td>
                            <td>{{ $banner->status ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
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
