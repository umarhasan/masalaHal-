@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('uploads/products/'.$product->image) }}" class="img-fluid" alt="{{ $product->name }}">
            @if($product->images->count())
            <div class="mt-3 d-flex flex-wrap">
                @foreach($product->images as $img)
                    <img src="{{ asset('uploads/products/gallery/'.$img->image) }}" class="img-thumbnail me-2 mb-2" style="width:70px; height:70px; object-fit:cover;">
                @endforeach
            </div>
            @endif
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <h4>
                @if($product->old_price)
                    <span class="text-muted text-decoration-line-through">${{ number_format($product->old_price, 2) }}</span>
                @endif
                <span class="fw-bold ms-1">${{ number_format($product->price, 2) }}</span>
            </h4>
            @if($product->sizes)
                <p>Size: {{ implode(', ', $product->sizes->pluck('size')->toArray()) }}</p>
            @endif
            @if($product->colors)
                <p>Color:
                    @foreach($product->colors as $color)
                        <span style="background-color: {{ $color->color_code ?? '#000' }}; display:inline-block; width:20px; height:20px; border-radius:50%; margin-right:5px;"></span>
                    @endforeach
                </p>
            @endif
        </div>
    </div>
</div>
@endsection
