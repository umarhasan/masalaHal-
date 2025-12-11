@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Add New Seller</h1>
        <a href="{{ route('sellers.index') }}" class="btn btn-secondary mb-2">Back</a>
    </section>

    <section class="content">
        <form action="{{ route('sellers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>User</label>
                <select name="user_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Store Name</label>
                <input type="text" name="store_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control">
            </div>

            <div class="mb-3">
                <label>Bio</label>
                <textarea name="bio" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Logo</label>
                <input type="file" name="logo" class="form-control">
            </div>

            <div class="mb-3">
                <label>Verified</label>
                <input type="checkbox" name="is_verified" value="1">
            </div>

            <button class="btn btn-success">Add Seller</button>
        </form>
    </section>
</div>
@endsection
