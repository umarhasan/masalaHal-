@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-10">
          <h1>Processes</h1>
        </div>
        <div class="col-sm-2">
          <a class="btn btn-success" href="{{ route('processes.create') }}"> New Process </a>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($items as $key => $process)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $process->title }}</td>
                    <td>{{ Str::limit($process->description, 50) }}</td>
                    <td>
                      @if($process->image)
                        <img src="{{ asset('storage/'.$process->image) }}" width="80">
                      @endif
                    </td>
                    <td>
                      <div class="dropdown">
