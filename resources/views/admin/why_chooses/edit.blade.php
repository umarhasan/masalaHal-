@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Item</h1>
    </section>

    <section class="content">
        <form action="{{ route('why_chooses.update', $why_choose->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" class="form-control" value="{{ $why_choose->title }}" required>
            </div>
            <div class="form-group">
                <strong>Description:</strong>
                <textarea name="description" class="form-control">{{ $why_choose->description }}</textarea>
            </div>
            <div class="form-group">
                <strong>Icon:</strong>
                <input type="file" name="icon" class="form-control">
                @if($why_choose->icon)
                    <img src="{{ asset('storage/'.$why_choose->icon) }}" width="50" class="mt-2">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </section>
</div>
@endsection
