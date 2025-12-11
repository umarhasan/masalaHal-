@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Brand</h1>
    </section>

    <section class="content">
        <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" value="{{ $brand->name }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" value="{{ $brand->slug }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Logo</label>
                <input type="file" name="logo" class="form-control">
                @if($brand->logo)<img src="{{ asset('uploads/brands/'.$brand->logo) }}" width="60">@endif
            </div>
            <button class="btn btn-success">Update Brand</button>
        </form>
    </section>
</div>
@endsection
