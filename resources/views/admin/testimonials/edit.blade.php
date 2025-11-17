@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Edit Testimonial</h1>
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
          <form method="POST" action="{{ route('testimonials.update', $testimonial->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label>Name</label>
              <input type="text" name="name" class="form-control" value="{{ old('name', $testimonial->name) }}" required>
            </div>

            <div class="mb-3">
              <label>Designation</label>
              <input type="text" name="designation" class="form-control" value="{{ old('designation', $testimonial->designation) }}" required>
            </div>

            <div class="mb-3">
              <label>Content</label>
              <textarea name="content" class="form-control" rows="4" required>{{ old('content', $testimonial->content) }}</textarea>
            </div>

            <div class="mb-3">
              <label>Image</label>
              <input type="file" name="image" class="form-control">
              @if($testimonial->image)
                <img src="{{ asset('storage/'.$testimonial->image) }}" width="120" class="mt-2">
              @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
