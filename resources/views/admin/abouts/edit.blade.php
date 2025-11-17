@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit About</h1>
    </section>

    <section class="content">
        <form action="{{ route('abouts.update', $about->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" class="form-control" value="{{ $about->title }}" required>
            </div>
            <div class="form-group">
                <strong>Description:</strong>
                <textarea name="description" class="form-control">{{ $about->description }}</textarea>
            </div>
            <div class="form-group">
                <strong>Image:</strong>
                <input type="file" name="image" class="form-control">
                @if($about->image)
                    <img src="{{ asset('storage/'.$about->image) }}" width="100" class="mt-2">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </section>
</div>
@endsection
