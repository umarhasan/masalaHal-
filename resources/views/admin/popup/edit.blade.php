@extends("admin.layouts.app")

@section("content")
<h2>Edit Popup Banner</h2>

<form action="{{ route('popup.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")

    <label>Title</label>
    <input type="text" name="title" class="form-control" value="{{ $banner->title }}">

    <label>Link (Optional)</label>
    <input type="text" name="link" class="form-control" value="{{ $banner->link }}">

    <label>Current Image</label><br>
    <img src="{{ $banner->image }}" width="120"><br><br>

    <label>New Image (Optional)</label>
    <input type="file" name="image" class="form-control">

    <label>Status</label>
    <select name="status" class="form-control">
        <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Inactive</option>
    </select>

    <br>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
