@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Brands</h1>
        <a href="{{ route('brands.create') }}" class="btn btn-success mb-2">New Brand</a>
    </section>

    <section class="content">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Logo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->slug }}</td>
                    <td>@if($brand->logo)<img src="{{ asset('uploads/brands/'.$brand->logo) }}" width="60">@endif</td>
                    <td>
                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
