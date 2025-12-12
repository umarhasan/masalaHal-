@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Create New Brand</h1>
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
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
