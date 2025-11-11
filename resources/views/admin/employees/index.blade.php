@extends('admin.layouts.app')


@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Employees</h1>
          </div>
          <div class="col-sm-2">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employees</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>CNIC</th>
                    <th>Full Address</th>
                    <th>CV</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if($employees)
                  @php
                  $id =1;
                  @endphp
                  @foreach($employees as $key =>  $emp)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $emp->first_name }}</td>
                    <td>{{ $emp->last_name }}</td>
                    <td>{{ $emp->phone }}</td>
                    <td>{{ $emp->city }}</td>
                    <td>{{ $emp->state }}</td>
                    <td>{{ $emp->country }}</td>
                    <td>{{ $emp->email }}</td>
                    <td>
                        @if($emp->image)
                            <img src="{{ asset('storage/' . $emp->image) }}" alt="Image" width="50">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $emp->cnic }}</td>
                    <td>{{ $emp->full_address }}</td>
                    <td>
                        @if($emp->cv)
                            <a href="{{ asset('storage/' . $emp->cv) }}" target="_blank">View CV</a>
                        @else
                            N/A
                        @endif
                    </td>
                    

			      </tr>
                  @endforeach
                  @endif
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S.No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>CNIC</th>
                    <th>Full Address</th>
                    <th>CV</th>
                  </tr>
                  </tfoot>
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
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
