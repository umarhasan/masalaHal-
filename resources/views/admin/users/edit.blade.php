@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Edit User</h1>
          </div>
          <div class="col-sm-2">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit / User</li>
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
                  <form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input class="form-control" value="{{ old('name', $user->name) }}" name="name" required>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Email:</strong>
                                <input class="form-control" value="{{ old('email', $user->email) }}" type="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Role:</strong>
                                <select name="roles[]" class="form-control" required>
                                    <option value="">Select role</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ in_array($role->name, old('roles', $user->getRoleNames()->toArray())) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Additional fields for User Information -->
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Phone:</strong>
                                <input class="form-control" value="{{ old('phone', $user->userInformation->phone ?? '') }}" type="text" name="phone">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Address:</strong>
                                <input class="form-control" value="{{ old('address', $user->userInformation->address ?? '') }}" type="text" name="address">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Website:</strong>
                                <input class="form-control" value="{{ old('webiste', $user->userInformation->website ?? '') }}" type="text" name="website">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Logo:</strong>
                                <input class="form-control" type="file" name="logo">
                                @if($user->userInformation && $user->userInformation->logo)
                                    <img src="{{ asset('storage/' . $user->userInformation->logo) }}" alt="Logo" class="img-thumbnail" width="150">
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Work Experience (Years):</strong>
                                <input class="form-control" value="{{ old('work_experience_years', $user->userInformation->work_experience_years ?? '') }}" type="number" name="work_experience_years">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Work Experience Details:</strong>
                                <textarea class="form-control" name="work_experience_details">{{ old('work_experience_details', $user->userInformation->work_experience_details ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Hobbies:</strong>
                                <select class="form-control" name="hobbies[]" multiple>
                                    <option value="Reading" {{ in_array('Reading', old('hobbies', $hobbies)) ? 'selected' : '' }}>Reading</option>
                                    <option value="Traveling" {{ in_array('Traveling', old('hobbies', $hobbies)) ? 'selected' : '' }}>Traveling</option>
                                    <option value="Cooking" {{ in_array('Cooking', old('hobbies', $hobbies)) ? 'selected' : '' }}>Cooking</option>
                                    <option value="Sports" {{ in_array('Sports', old('hobbies', $hobbies)) ? 'selected' : '' }}>Sports</option>
                                    <option value="Photography" {{ in_array('Photography', old('hobbies', $hobbies)) ? 'selected' : '' }}>Photography</option>
                                    <option value="Music" {{ in_array('Music', old('hobbies', $hobbies)) ? 'selected' : '' }}>Music</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Country:</strong>
                                <input class="form-control" value="{{ old('country', $user->userInformation->country ?? '') }}" type="text" name="country">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>State:</strong>
                                <input class="form-control" value="{{ old('state', $user->userInformation->state ?? '') }}" type="text" name="state">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>City:</strong>
                                <input class="form-control" value="{{ old('city', $user->userInformation->city ?? '') }}" type="text" name="city">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>ZIP Code:</strong>
                                <input class="form-control" value="{{ old('zip_code', $user->userInformation->zip_code ?? '') }}" type="text" name="zip_code">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Profile Image:</strong>
                                @if($user->userInformation && $user->userInformation->profile_image)
                                    <img src="{{ asset('storage/' . $user->userInformation->profile_image) }}" alt="Profile Image" class="img-thumbnail" width="150">
                                @endif
                                <input class="form-control" type="file" name="images[]" multiple>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Industry Type:</strong>
                                <input class="form-control" value="{{ old('industry_type', $user->userInformation->industry_type ?? '') }}" type="text" name="industry_type">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Number of Employees:</strong>
                                <input class="form-control" value="{{ old('number_of_employees', $user->userInformation->number_of_employees ?? '') }}" type="number" name="number_of_employees">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Description:</strong>
                                <textarea class="form-control" name="description">{{ old('description', $user->userInformation->description ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Founded Year:</strong>
                                <input class="form-control" value="{{ old('founded_year', $user->userInformation->founded_year ?? '') }}" type="number" name="founded_year">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Registration Number:</strong>
                                <input class="form-control" value="{{ old('registration_number', $user->userInformation->registration_number ?? '') }}" type="text" name="registration_number">
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Social Links:</strong>
                                <textarea class="form-control" name="social_links[]">{{ old('social_links', implode(', ', $social_links)) }}</textarea>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                            <button type="submit" class="btn btn-primary">Update</button>
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
