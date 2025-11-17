@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Show Item</h1>
        <a href="{{ route('why_chooses.index') }}" class="btn btn-primary mb-2">Back</a>
    </section>

    <section class="content">
        <div><strong>Title:</strong> {{ $why_choose->title }}</div>
        <div><strong>Description:</strong> {{ $why_choose->description }}</div>
        <div>
            <strong>Icon:</strong>
            @if($why_choose->icon)
                <img src="{{ asset('storage/'.$why_choose->icon) }}" width="80">
            @endif
        </div>
    </section>
</div>
@endsection
