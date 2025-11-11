@extends('admin.layouts.app')

@section('title', 'Edit Slider')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1>Edit Slider</h1>
                </div>
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Slider</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $slider->title }}" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control">{{ $slider->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Current Image</label><br>
                    <img src="{{ asset('storage/' . $slider->image) }}" alt="Current Image" width="150">
                </div>

                <div class="mb-3">
                    <label>Upload New Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Update Slider</button>
                <a href="{{ route('sliders.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </section>
</div>
@endsection
