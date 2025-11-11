@extends('admin.layouts.app')

@section('content')
<style>
  /* Disable text selection */
  .no-select {
      -webkit-user-select: none; /* Safari */
      -moz-user-select: none;    /* Firefox */
      -ms-user-select: none;     /* IE10+/Edge */
      user-select: none;         /* Standard */
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      // Disable right-click context menu
      document.body.addEventListener('contextmenu', function(e) {
          e.preventDefault();
      });

      // Disable copy, cut, and paste
      document.body.addEventListener('copy', function(e) {
          e.preventDefault();
      });
      document.body.addEventListener('cut', function(e) {
          e.preventDefault();
      });
      document.body.addEventListener('paste', function(e) {
          e.preventDefault();
      });
  });
</script>

<div class="content-wrapper no-select">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Leads</h1>
          </div>
          <div class="col-sm-2">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Leads</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ $message }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card shadow-sm">
              <div class="card-body">
                <table id="example" class="table table-hover table-striped align-middle no-select">
                  <thead class="table-primary">
                  <tr>
                    <th>#</th>
                    <th>Company</th>
                    <th>Lead Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Zip</th>
                    <th>Address</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if($leads)
                      @foreach($leads as $key => $lead)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <strong>{{ isset($lead->users) ? $lead->users->name : '' }}</strong>
                            @if($lead->status == 1)
                                <span class="badge bg-success ms-2" data-bs-toggle="tooltip" title="This lead has been picked">Picked</span>
                            @else
                                <span class="badge bg-warning text-dark ms-2" data-bs-toggle="tooltip" title="This lead is not picked">Not Picked</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.leads.show', $lead->id) }}" class="text-decoration-none">
                                {{ $lead->name }}
                            </a>
                        </td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->phone }}</td>
                        <td>{{ $lead->zip }}</td>
                        <td>{{ $lead->address }}</td>
                      </tr>
                    @endforeach
                  @endif
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </section>
</div>
@endsection
