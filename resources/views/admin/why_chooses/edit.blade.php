@extends('admin.layouts.app')
@section('content')
<div class="container">
    <h2>Edit Why Choose Us</h2>
    <form action="{{ route('why-chooses.update', $whyChoose->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $whyChoose->title }}" required>
        </div>
        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control" value="{{ $whyChoose->subtitle }}">
        </div>
        <div class="mb-3">
            <label>Section</label>
            <input type="text" name="section" class="form-control" value="{{ $whyChoose->section }}">
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $whyChoose->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @if($whyChoose->image)
                <img src="{{ asset($whyChoose->image) }}" width="80" alt="">
            @endif
        </div>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
