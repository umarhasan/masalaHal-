@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
            <h1>Processes</h1>
            <a class="btn btn-success" href="{{ route('processes.create') }}">New Step</a>
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
                                <th>Step Number</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($processes as $key => $process)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $process->step_number }}</td>
                                <td>{{ $process->title }}</td>
                                <td>{{ Str::limit($process->description,50) }}</td>
                                <td>
                                    @if($process->image)
                                        <img src="{{ asset('storage/'.$process->image) }}" width="80">
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn p-0 dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('processes.show', $process->id) }}">View</a>
                                            <a class="dropdown-item" href="{{ route('processes.edit', $process->id) }}">Edit</a>
                                            <form action="{{ route('processes.destroy', $process->id) }}" method="POST">
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
