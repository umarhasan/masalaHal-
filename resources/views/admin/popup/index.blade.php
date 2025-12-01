@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Popup Banners</h1>
          </div>
          <div class="col-sm-2">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Popup Banner</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">

            <div class="card">

              <!-- Top Button -->
              <div class="card-header">
                <a class="btn btn-success" href="{{ route('popup.create') }}">Add New Popup Banner</a>
              </div>

              <!-- Table -->
              <div class="card-body">
                <table id="example" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Image</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($banners as $key => $b)
                    <tr>
                      <td>{{ $key + 1 }}</td>

                      <td>
                        <img src="{{ $b->image }}" width="120" style="border-radius:5px;">
                      </td>

                      <td>
                        @if($b->status)
                          <span class="badge bg-success">Active</span>
                        @else
                          <span class="badge bg-danger">Inactive</span>
                        @endif
                      </td>

                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                          </button>

                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('popup.edit', $b->id) }}">
                              <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>

                            <form action="{{ route('popup.destroy', $b->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" onclick="return confirm('Delete this banner?')" class="dropdown-item">
                                  <i class="bx bx-trash-alt me-1"></i> Delete
                              </button>
                            </form>
                          </div>
                        </div>
                      </td>

                    </tr>
                    @endforeach
                  </tbody>

                  <tfoot>
                    <tr>
                      <th>S.No</th>
                      <th>Image</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>

                </table>
              </div>

            </div>

          </div>
        </div>

      </div>
    </section>

</div>

@endsection
