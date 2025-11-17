@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Show Process</h1>
      <a href="{{ route('processes.index') }}" class="btn btn-primary mb-3">Back</a>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <p><strong>Title:</strong> {{ $process->title }}</p>
          <p><strong>Description:</strong> {{ $process->description }}</p>
          @if($process->image)
            <p><strong>Image:</strong></p>
            <img src="{{ asset('storage/'.$process->image) }}" width="200">
          @endif
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
