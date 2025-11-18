@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Show Testimonial</h1>
      <a href="{{ route('admin.testimonials.index') }}" class="btn btn-primary mb-3">Back</a>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <p><strong>Name:</strong> {{ $testimonial->name }}</p>
          <p><strong>Designation:</strong> {{ $testimonial->designation }}</p>
          <p><strong>Content:</strong> {{ $testimonial->content }}</p>
          <p><strong>Rating:</strong> {{ $testimonial->rating }}</p>
          @if($testimonial->image)
            <p><strong>Image:</strong></p>
            <img src="{{ asset('storage/'.$testimonial->image) }}" width="200">
          @endif
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
