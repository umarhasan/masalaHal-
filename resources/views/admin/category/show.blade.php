@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h2>Category Details</h2>
            <a class="btn btn-secondary mb-2" href="{{ route('categories.index') }}">Back to List</a>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group">
                        <strong>Name:</strong> {{ $category->name }}
                    </div>
                    <div class="form-group">
                        <strong>Slug:</strong> {{ $category->slug }}
                    </div>
                    <div class="form-group">
                        <strong>Status:</strong> {{ $category->status ? 'Active' : 'Inactive' }}
                    </div>
                    <div class="form-group">
                        <strong>Image:</strong>
                        @if($category->image)
                            <br>
                            <img src="{{ asset('uploads/categories/'.$category->image) }}" width="120">
                        @else
                            N/A
                        @endif
                    </div>
                    <div class="form-group">
                        <strong>Created At:</strong> {{ $category->created_at->format('d M, Y') }}
                    </div>
                    <div class="form-group">
                        <strong>Updated At:</strong> {{ $category->updated_at->format('d M, Y') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
