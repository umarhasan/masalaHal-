@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-9">
          <h1>Edit Product</h1>
        </div>
        <div class="col-sm-3">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Product</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      @if($errors->any())
      <div class="alert alert-danger">
        <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
      </div>
      @endif

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <strong>Category:</strong>
                      <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <strong>Product Name:</strong>
                      <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <strong>Description:</strong>
                      <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <strong>Price:</strong>
                      <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <strong>Stock:</strong>
                      <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <strong>Main Image:</strong>
                      <input type="file" name="image" class="form-control">
                      @if($product->image)
                        <img src="{{ asset('uploads/products/'.$product->image) }}" width="60" class="mt-2">
                      @endif
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <strong>Gallery Images:</strong>
                      <input type="file" name="gallery[]" class="form-control" multiple>
                      @if($product->images)
                        <div class="mt-2">
                          @foreach($product->images as $img)
                          <img src="{{ asset('uploads/products/gallery/'.$img->image) }}" width="50" class="me-1 mb-1">
                          @endforeach
                        </div>
                      @endif
                    </div>
                  </div>

                  <!-- Colors -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <strong>Colors:</strong>
                      <div id="color-wrapper">
                        @foreach($product->colors as $i => $color)
                        <div class="color-row mb-2">
                          <input type="text" name="colors[{{$i}}][name]" value="{{ $color->color_name }}" placeholder="Color Name" class="form-control d-inline-block w-50">
                          <input type="color" name="colors[{{$i}}][code]" value="{{ $color->color_code }}" class="form-control d-inline-block w-25">
                          <button type="button" class="btn btn-danger btn-sm remove-color">Remove</button>
                        </div>
                        @endforeach
                      </div>
                      <button type="button" id="add-color" class="btn btn-info btn-sm mt-2">Add More Color</button>
                    </div>
                  </div>

                  <!-- Sizes -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <strong>Sizes:</strong>
                      <input type="text" name="sizes[]" class="form-control" value="{{ implode(',', $product->sizes->pluck('size')->toArray()) }}" placeholder="S,M,L">
                    </div>
                  </div>

                  <div class="col-md-12 text-right">
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

<script>
let colorIndex = {{ count($product->colors) }};
document.getElementById('add-color').addEventListener('click', function(){
    let wrapper = document.getElementById('color-wrapper');
    let div = document.createElement('div');
    div.classList.add('color-row','mb-2');
    div.innerHTML = `<input type="text" name="colors[${colorIndex}][name]" placeholder="Color Name" class="form-control d-inline-block w-50">
                     <input type="color" name="colors[${colorIndex}][code]" class="form-control d-inline-block w-25">
                     <button type="button" class="btn btn-danger btn-sm remove-color">Remove</button>`;
    wrapper.appendChild(div);
    colorIndex++;
});

document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove-color')) e.target.parentElement.remove();
});
</script>
@endsection
