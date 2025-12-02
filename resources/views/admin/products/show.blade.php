@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="row">
      <div class="col-lg-12 margin-tb">
        <div class="pull-left">
          <h2>Show Product</h2>
        </div>
        <div class="pull-right">
          <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-6">
        <strong>Category:</strong> {{ $product->category?->name }}
      </div>
      <div class="col-md-6">
        <strong>Name:</strong> {{ $product->name }}
      </div>
      <div class="col-md-6">
        <strong>Price:</strong> {{ $product->price }}
      </div>
      <div class="col-md-6">
        <strong>Stock:</strong> {{ $product->stock }}
      </div>
      <div class="col-md-6">
        <strong>Main Image:</strong><br>
        @if($product->image)
        <img src="{{ asset('uploads/products/'.$product->image) }}" width="100">
        @endif
      </div>
      <div class="col-md-6">
        <strong>Gallery:</strong><br>
        @foreach($product->images as $img)
        <img src="{{ asset('uploads/products/gallery/'.$img->image) }}" width="50" class="me-1 mb-1">
        @endforeach
      </div>
      <div class="col-md-12">
        <strong>Description:</strong><br>{{ $product->description }}
      </div>
      <div class="col-md-12 mt-2">
        <strong>Colors:</strong>
        @foreach($product->colors as $color)
          <span class="badge" style="background-color: {{ $color->color_code }}">{{ $color->color_name }}</span>
        @endforeach
      </div>
      <div class="col-md-12 mt-2">
        <strong>Sizes:</strong> {{ implode(', ', $product->sizes->pluck('size')->toArray()) }}
      </div>
    </div>
  </section>
</div>
@endsection
