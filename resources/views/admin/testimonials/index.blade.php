@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
      <h1>Testimonials</h1>
      <a class="btn btn-success" href="{{ route('testimonials.create') }}"> New Testimonial </a>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <div class="card">
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Content</th>
                <th>Rating</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($items as $key => $testimonial)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $testimonial->name }}</td>
                <td>{{ $testimonial->designation }}</td>
                <td>{{ Str::limit($testimonial->content, 50) }}</td>
                <td>{{ $testimonial->rating }}</td>
                <td>
                  @if($testimonial->image)
                    <img src="{{ asset('storage/'.$testimonial->image) }}" width="80">
                  @endif
                </td>
                <td>
                  <div class="dropdown">
                    <button class="btn p-0 dropdown-toggle" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('testimonials.show', $testimonial->id) }}">View</a>
                      <a class="dropdown-item" href="{{ route('testimonials.edit', $testimonial->id) }}">Edit</a>
                      <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item">Delete</button>
                      </form>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
