@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
            <h1>Blogs</h1>
            <a class="btn btn-success" href="{{ route('blogs.create') }}">New Blog</a>
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
                                <th>Title</th>
                                <th>Author</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $key => $blog)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ Str::limit($blog->title,50) }}</td>
                                <td>{{ $blog->author }}</td>
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
                                            <a class="dropdown-item" href="{{ route('blogs.show', $blog->id) }}">View</a>
                                            <a class="dropdown-item" href="{{ route('blogs.edit', $blog->id) }}">Edit</a>
                                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
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
