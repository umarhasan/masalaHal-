@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Create Package</h1>
          </div>
          <div class="col-sm-2">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Package</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
    <div class="container-fluid">

        <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                  <form method="POST" action="{{ route('package.store') }}">
                      @csrf
                      <div class="form-group">
                          <label for="name">Name:</label>
                          <input type="text" name="name" class="form-control" placeholder="Name" required>
                      </div>
                      <div class="form-group">
                          <label for="amount">Amount:</label>
                          <input type="number" name="amount" class="form-control" placeholder="$500" required>
                      </div>
                      <div class="form-group">
                          <label for="amount">Credit:</label>
                          <input type="number" name="credit" class="form-control" placeholder="100" required>
                      </div>
                      <div class="form-group">
                          <label for="description">Description:</label>
                          <textarea name="description" class="form-control" placeholder="Lorem Ipsum is simply dummy" required></textarea>
                      </div></br>
                      <button type="submit" class="btn btn-primary">Create</button>
                  </form>
                  </div>
              </div>
          </div>
        </div>
    </div>
</section>
  </div>

@endsection
