@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Show Team Member</h1>
      <a href="{{ route('teams.index') }}" class="btn btn-primary mb-3">Back</a>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <p><strong>Name:</strong> {{ $team->name }}</p>
          <p><strong>Designation:</strong> {{ $team->designation }}</p>
          @if($team->image)
            <p><strong>Image:</strong></p>
            <img src="{{ asset('storage/'.$team->image) }}" width="200">
          @endif
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
