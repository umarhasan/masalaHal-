@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Create Brand</h1>
    </section>

    <section class="content">
        <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Logo</label>
                <input type="file" name="logo" class="form-control">
            </div>
            <button class="btn btn-success">Save Brand</button>
        </form>
    </section>
</div>
@endsection
