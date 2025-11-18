@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Create New Testimonial</h1>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      @if($errors->any())
        <div class="alert alert-danger">
          <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
      @endif

      <div class="card">
        <div class="card-body">
          <form method="POST" action="{{ route('testimonials.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
              <label>Name</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
              <label>Designation</label>
              <input type="text" name="designation" class="form-control" value="{{ old('designation') }}">
            </div>

            <div class="mb-3">
              <label>Content</label>
              <textarea name="content" class="form-control" rows="4" required>{{ old('content') }}</textarea>
            </div>

            <div class="mb-3">
              <label>Rating</label>
              <input type="number" name="rating" class="form-control" value="{{ old('rating', 5) }}" min="1" max="5">
            </div>

            <div class="mb-3">
              <label>Image</label>
              <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
