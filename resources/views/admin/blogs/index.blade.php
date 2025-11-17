@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-10">
          <h1>Blogs</h1>
        </div>
        <div class="col-sm-2">
          <a class="btn btn-success" href="{{ route('blogs.create') }}"> New Blog </a>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($items as $key => $blog)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $blog->title }}</td>
                    <td>
                      @if($blog->image)
                        <img src="{{ asset('storage/'.$blog->image) }}" width="80">
                      @endif
                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn p-0 dropdown-toggle" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{ route('blogs.show', $blog->id) }}">
                            <i class="bx bx-show-alt me-1"></i> View
                          </a>
                          <a class="dropdown-item" href="{{ route('blogs.edit', $blog->id) }}">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                          </a>
                          <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item">
                              <i class="bx bx-trash-alt me-1"></i> Delete
                            </button>
                          </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div> <!-- card-body -->
          </div> <!-- card -->
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
