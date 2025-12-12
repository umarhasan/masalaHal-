@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Brand</h1>
            <a href="{{ route('brands.index') }}" class="btn btn-secondary mb-2">Back</a>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $brand->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ $brand->slug }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @if($brand->logo)
                                <img src="{{ asset('uploads/brands/'.$brand->logo) }}" width="80" class="mt-2">
                            @endif
                        </div>

                        <button class="btn btn-success">Update Brand</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
