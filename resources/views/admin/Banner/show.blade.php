@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Brand Details</h1>
        <a href="{{ route('brands.index') }}" class="btn btn-secondary mb-2">Back</a>
    </section>

    <section class="content">
        <table class="table table-bordered">
            <tr><th>Name</th><td>{{ $brand->name }}</td></tr>
            <tr><th>Slug</th><td>{{ $brand->slug }}</td></tr>
            <tr><th>Logo</th>
                <td>
                    @if($brand->logo)
                        <img src="{{ asset('uploads/brands/'.$brand->logo) }}" width="100">
                    @endif
                </td>
            </tr>
            <tr><th>Created At</th><td>{{ $brand->created_at->format('d M Y') }}</td></tr>
            <tr><th>Updated At</th><td>{{ $brand->updated_at->format('d M Y') }}</td></tr>
        </table>
    </section>
</div>
@endsection
