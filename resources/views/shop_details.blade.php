@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Product Images -->
        <div class="col-md-6">
            <img src="{{ $product->image ? asset('uploads/products/'.$product->image) : 'https://via.placeholder.com/400x400' }}"
                 class="img-fluid mb-3" style="width:100%; object-fit: cover;">
            <div class="d-flex flex-wrap gap-2">
                @foreach($product->images as $img)
                    <img src="{{ $img->image ? asset('uploads/products/'.$img->image) : 'https://via.placeholder.com/80' }}"
                         style="width:80px; height:80px; object-fit: cover; border:1px solid #ddd; padding:2px;">
                @endforeach
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h3>{{ $product->name }}</h3>
            <p class="h4 text-primary">Rs. {{ $product->sale_price ?? $product->price }}</p>
            <p><strong>Condition:</strong> {{ ucfirst($product->condition) }}</p>

            <!-- Add to Cart Form -->
            <form id="add-to-cart-form" data-id="{{ $product->id }}">
                @csrf
                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="number" name="quantity" value="1" min="1" class="form-control" style="width:120px;">
                </div>
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('add-to-cart-form');
    form.addEventListener('submit', function(e){
        e.preventDefault();
        let productId = this.dataset.id;
        let quantity = this.querySelector('input[name="quantity"]').value;
        let token = this.querySelector('input[name="_token"]').value;

        fetch("{{ route('cart.add') }}", {
            method: "POST",
            headers: {
                'Content-Type':'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        }).then(res => res.json())
        .then(data => {
            alert(data.message || 'Added to cart');
            updateHeaderCart(data.cart);
        }).catch(err => console.log(err));
    });

    function updateHeaderCart(cart) {
        let count = cart.items.reduce((sum, i) => sum + i.quantity, 0);
        let badge = document.querySelector('#cartDropdown .badge');
        if(count > 0){
            if(badge){
                badge.textContent = count;
            } else {
                let span = document.createElement('span');
                span.className = "badge bg-danger position-absolute top-0 start-100 translate-middle";
                span.textContent = count;
                document.querySelector('#cartDropdown a').appendChild(span);
            }
        } else if(badge){
            badge.remove();
        }
    }
});
</script>
@endsection
