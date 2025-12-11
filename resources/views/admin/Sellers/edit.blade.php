@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Seller</h1>
        <a href="{{ route('sellers.index') }}" class="btn btn-secondary mb-2">Back</a>
    </section>

    <section class="content">
        <form action="{{ route('sellers.update', $seller->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Store Name</label>
                <input type="text" name="store_name" value="{{ $seller->store_name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" value="{{ $seller->slug }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Bio</label>
                <textarea name="bio" class="form-control">{{ $seller->bio }}</textarea>
            </div>

            <div class="mb-3">
                <label>Logo</label>
                <input type="file" name="logo" class="form-control">
                @if($seller->logo)
                    <img src="{{ asset('uploads/sellers/'.$seller->logo) }}" width="60" class="mt-2">
                @endif
            </div>

            <div class="mb-3">
                <label>Verified</label>
                <input type="checkbox" name="is_verified" value="1" @if($seller->is_verified) checked @endif>
            </div>

            <button class="btn btn-success">Update Seller</button>
        </form>
    </section>
</div>
@endsection
