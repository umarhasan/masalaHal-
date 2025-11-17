@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Create New Process</h1>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="card">
        <div class="card-body">
          <form method="POST" action="{{ route('processes.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label>Title</label>
              <in
