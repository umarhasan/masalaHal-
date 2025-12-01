@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1>Team Members</h1>
            <a href="{{ route('teams.create') }}" class="btn btn-primary">Add New Member</a>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">

                <div class="card-body table-responsive p-0">

                    <table id="example" class="table table-bordered table-hover text-nowrap">
                        <thead class="bg-light">
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Image</th>
                                <th>Facebook</th>
                                <th>Twitter</th>
                                <th>LinkedIn</th>
                                <th width="160px">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($teams as $team)
                                <tr>
                                    <td>{{ $team->name }}</td>
                                    <td>{{ $team->role }}</td>
                                    <td>
                                        @if($team->image)
                                            <img src="{{ asset($team->image) }}" width="60" class="rounded">
                                        @endif
                                    </td>
                                    <td>{{ $team->facebook }}</td>
                                    <td>{{ $team->twitter }}</td>
                                    <td>{{ $team->linkedin }}</td>
                                    <td>
                                        <a href="{{ route('teams.show', $team->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                        <form action="{{ route('teams.destroy', $team->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
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
