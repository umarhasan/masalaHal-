@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Team Members</h1>

    
    <a href="{{ route('teams.create') }}" class="btn btn-primary mb-3">Add New Team Member</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Image</th>
                <th>Facebook</th>
                <th>Twitter</th>
                <th>LinkedIn</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teams as $team)
            <tr>
                <td>{{ $team->name }}</td>
                <td>{{ $team->role }}</td>
                <td>
                    @if($team->image)
                        <img src="{{ asset($team->image) }}" alt="Image" width="50">
                    @endif
                </td>
                <td>{{ $team->facebook }}</td>
                <td>{{ $team->twitter }}</td>
                <td>{{ $team->linkedin }}</td>
                <td>

                    <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('teams.destroy', $team->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
