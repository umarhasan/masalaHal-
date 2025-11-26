@extends("admin.layouts.app")

@section("content")
<h2>Add Popup Banner</h2>

<form action="{{ route('popup.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Title</label>
    <input type="text" name="title" class="form-control">

    <label>Link (Optional)</label>
    <input type="text" name="link" class="form-control">

    <label>Image</label>
    <input type="file" name="image" class="form-control">

    <label>Status</label>
    <select name="status" class="form-control">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>

    <br>
    <button class="btn btn-primary">Save</button>
</form>
@endsection
