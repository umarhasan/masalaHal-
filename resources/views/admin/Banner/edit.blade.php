@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Banner</h1>
        <a href="{{ route('banners.index') }}" class="btn btn-secondary mb-2">Back</a>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $banner->title }}">
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        @if($banner->image)
                            <img src="{{ asset('uploads/banners/'.$banner->image) }}" width="80" class="mt-2">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label>Link</label>
                        <input type="text" name="link" class="form-control" value="{{ $banner->link }}">
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" @if($banner->status) selected @endif>Active</option>
                            <option value="0" @if(!$banner->status) selected @endif>Inactive</option>
                        </select>
                    </div>
                    <button class="btn btn-success">Update Banner</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
