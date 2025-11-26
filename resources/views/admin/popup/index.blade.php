@extends("admin.layouts.app")

@section("content")
<h2>Popup Banners</h2>

<a href="{{ route('popup.create') }}" class="btn btn-primary">Add New</a>

<table class="table mt-3">
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    @foreach($banners as $b)
    <tr>
        <td>{{ $b->id }}</td>
        <td><img src="{{ $b->image }}" width="120"></td>
        <td>{{ $b->status ? 'Active' : 'Inactive' }}</td>
        <td>
            <a href="{{ route('popup.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('popup.destroy', $b->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method("DELETE")
                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
