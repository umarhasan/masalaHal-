@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Show User</h1>
          </div>

          <div class="col-sm-2">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Show User</li>
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

              <div class="card-header">
                <a class="btn btn-primary" href="{{ route('users.index') }}">Back</a>
              </div>

              <div class="card-body">

                <div class="row">

                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <strong>Name:</strong>
                        <div>{{ $user->name }}</div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <strong>Email:</strong>
                        <div>{{ $user->email }}</div>
                    </div>

                    <!-- Roles -->
                    <div class="col-md-12 mb-3">
                        <strong>Roles:</strong><br>

                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <span class="badge bg-success">{{ $v }}</span>
                            @endforeach
                        @else
                            <span class="badge bg-secondary">No Role Assigned</span>
                        @endif
                    </div>

                </div>

              </div>

            </div>

          </div>
        </div>

      </div>
    </section>

</div>
@endsection
