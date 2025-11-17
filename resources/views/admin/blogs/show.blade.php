@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Show Blog</h1>
      <a href="{{ route('blogs.index') }}" class="btn btn-primary mb-3">Back</a>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <p><strong>Title:</strong> {{ $blog->title }}</p>
          <p><strong>Content:</strong> {{ $blog->content }}</p>
          @if($blog->image)
            <p><strong>Image:</strong></p>
            <img src="{{ asset('storage/'.$blog->image) }}" width="200">
          @endif
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
