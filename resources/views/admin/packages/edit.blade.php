@extends('admin.layouts.app')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Package</h1>
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
                  <form method="POST" action="{{ route('package.update', $package->id) }}">
                      @csrf
                      @method('PATCH')
                      <div class="form-group">
                          <label for="name">Name:</label>
                          <input type="text" name="name" class="form-control" value="{{ $package->name }}" required>
                      </div>
                      <div class="form-group">
                          <label for="amount">Amount:</label>
                          <input type="text" name="amount" class="form-control" value="{{ $package->amount }}" required>
                      </div>
                      <div class="form-group">
                          <label for="amount">Credit:</label>
                          <input type="text" name="credit" class="form-control" value="{{ $package->credit }}" required>
                      </div>
                      <div class="form-group">
                          <label for="description">Description:</label>
                          <textarea name="description" class="form-control" required>{{ $package->description }}</textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Update</button>
                  </form>
                  </div>
              </div>
          </div>
        </div>
    </div>
</section>
  </div>
  <script>

$('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
  theme: 'bootstrap4'
})

  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": []
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script type="text/javascript">

 var APP_URL = {!! json_encode(url('/')) !!}




</script>
<style>
  .form-check-input{
    border-radius: 0 !important;
    height: 20px;
    width: 20px;
    margin:0;
  }

  .form-group strong{
    margin: 0 0 10px;
    width: fit-content;
    display: block;
  }

  .my-txt-box{
    padding: 0 0 10px;
  }

  .my-label{
    padding-left: 30px;
    text-transform:capitalize;
  }
  </style>


@endsection
