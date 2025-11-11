@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-9">
            <h1>Create New User</h1>
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create New User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
    <div class="container-fluid">
        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
               @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
               @endforeach
            </ul>
          </div>
        @endif
        <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                  <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Email:</strong>
                                <input class="form-control" type="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Password:</strong>
                                <input class="form-control" type="password" name="password" required>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Confirm Password:</strong>
                                <input class="form-control" type="password" name="confirm-password" required>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Role:</strong>
                                <select name="roles[]" class="form-control" required>
                                    <option>select role</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Additional fields for User Information -->
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Phone:</strong>
                                <input class="form-control" type="text" name="phone">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Website:</strong>
                                <input class="form-control" type="text" name="website">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>logo:</strong>
                                <input class="form-control" type="file" name="logo">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Address:</strong>
                                <input class="form-control" type="text" name="address">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Work Experience (Years):</strong>
                                <input class="form-control" type="number" name="work_experience_years">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Work Experience Details:</strong>
                                <textarea class="form-control" name="work_experience_details"></textarea>
                            </div>
                        </div>



                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Country:</strong>
                                <input class="form-control" type="text" name="country">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>State:</strong>
                                <input class="form-control" type="text" name="state">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>City:</strong>
                                <input class="form-control" type="text" name="city">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>ZIP Code:</strong>
                                <input class="form-control" type="text" name="zip_code">
                            </div>
                        </div>
                        <!-- Hobbies as Multiple Select Dropdown -->
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Hobbies:</strong>
                                <select class="form-control" name="hobbies[]" multiple>
                                    <option value="Reading">Reading</option>
                                    <option value="Traveling">Traveling</option>
                                    <option value="Cooking">Cooking</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Photography">Photography</option>
                                    <option value="Music">Music</option>
                                    <!-- Add more hobbies here -->
                                </select>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Industry Type:</strong>
                                <input class="form-control" type="text" name="industry_type">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Number of Employees:</strong>
                                <input class="form-control" type="number" name="number_of_employees">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Description:</strong>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Founded Year:</strong>
                                <input class="form-control" type="number" name="founded_year">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Registration Number:</strong>
                                <input class="form-control" type="text" name="registration_number">
                            </div>
                        </div>

                        <!-- Social Links (as Array) -->
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Social Links:</strong>
                                <input class="form-control" type="text" name="social_links[]" placeholder="Enter social links separated by commas">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Profile Image:</strong>
                                <input class="form-control" type="file" name="images[]" multiple>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                  </form>
                  </div>
              </div>
          </div>
        </div>
    </div>
</section>
</div>
@endsection
