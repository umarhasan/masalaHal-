@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Add Popup</h1>
          </div>
          <div class="col-sm-2">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Popup</li>
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
                <h3 class="card-title">Create New Popup Banner</h3>
              </div>

              <div class="card-body">

                <form action="{{ route('popup.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf

                  <div class="row">

                    <!-- Title -->
                    <div class="col-md-6 mb-3">
                      <label><strong>Title:</strong></label>
                      <input type="text" name="title" class="form-control" placeholder="Enter title" required>
                    </div>

                    <!-- Link -->
                    <div class="col-md-6 mb-3">
                      <label><strong>Link (Optional):</strong></label>
                      <input type="text" name="link" class="form-control" placeholder="Enter link (optional)">
                    </div>

                    <!-- Image -->
                    <div class="col-md-6 mb-3">
                      <label><strong>Image:</strong></label>
                      <input type="file" name="image" class="form-control" onchange="loadPreview(event)" required>

                      <img id="previewImg" src="" style="width:150px; margin-top:10px; display:none; border-radius:5px;">
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                      <label><strong>Status:</strong></label>
                      <select name="status" class="form-control" required>
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                      </select>
                    </div>

                    <!-- Submit -->
                    <div class="col-12 text-center mt-3">
                      <button type="submit" class="btn btn-primary">Save Banner</button>
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

{{-- Image Preview Script --}}
<script>
function loadPreview(event) {
    let output = document.getElementById('previewImg');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.style.display = "block";
}
</script>

@endsection
