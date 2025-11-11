@extends('customer.layouts.app')

@section('content')
<style>
  /* Disable text selection */
  .no-select {
      -webkit-user-select: none; /* Safari */
      -moz-user-select: none;    /* Firefox */
      -ms-user-select: none;     /* IE10+/Edge */
      user-select: none;         /* Standard */
  }

  /* Additional styles for read more text */
  .morecontent span {
    display: none;
  }
  .morelink {
    display: block;
    color: #0066cc;
    cursor: pointer;
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
          <div class="col-sm-9">
            <h1>Purchase Leads Pick</h1>
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Leads / Picked</li>
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
                    <th>Need</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Zip</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($leads as $key => $lead)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>
                          <a href="{{ route('company.leads.show',$lead->id) }}">{{ $lead->need }}</a>
                      </td>
                      <td>{{ is_null($lead->assign_company_id) ? 'N/A' : $lead->email }}</td>
                      <td>{{ is_null($lead->assign_company_id) ? 'N/A' : $lead->address }}</td>
                      <td>{{ is_null($lead->assign_company_id) ? 'N/A' : $lead->phone }}</td>
                      <td>{{ is_null($lead->assign_company_id) ? 'N/A' : $lead->zip }}</td>
                      <td>
                          @if(is_null($lead->assign_company_id))
                              <a href="{{ route('company.purchase.package', $lead->id) }}" class="btn btn-primary">Pick</a>
                          @elseif($lead->status == 1)
                              <span class="badge bg-success ms-2">Picked</span>
                          @else
                              <span class="badge bg-warning text-dark">Not Picked</span>
                          @endif
                      </td>
                    </tr>
                  @endforeach
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
