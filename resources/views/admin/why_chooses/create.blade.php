@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Create Why Choose Us Item</h1>
    </section>

    <section class="content">
        <form action="{{ route('why_chooses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <strong>Description:</strong>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <strong>Icon:</strong>
                <input type="file" name="icon" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>
</div>
@endsection
