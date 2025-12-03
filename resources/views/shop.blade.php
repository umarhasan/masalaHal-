@extends('layouts.app')

@section('content')
<div class="shop-section">
    <div class="container">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-lg-3 col-md-12 pr-0 pl-0">

                <!-- Categories Widget -->
                <div class="widget-check-box">
                    <div class="categories-title">
                        <h4> Categories </h4>
                    </div>
                    @foreach($categories as $category)
                        <label class="widget-check">
                            {{ $category->name }} <p>({{ $category->products->count() }})</p>
                            <input type="checkbox" name="category[]" value="{{ $category->id }}">
                            <span class="checkmark"></span>
                        </label>
                    @endforeach
                </div>

                <!-- Price Range Widget -->
                <div class="range-wrapper-box mt-4">
                    <div class="categories-title">
                        <h4> Price Range </h4>
                    </div>
                    <div id="slider-range"></div>
                    <div class="slider-labels d-flex justify-content-between mt-2">
                        <span id="slider-range-value1"></span>
                        <span id="slider-range-value2"></span>
                    </div>
                </div>

                <!-- Popular Products -->
                <div class="product-categories-box mt-4">
                    <div class="categories-title">
                        <h4> Popular Products </h4>
                    </div>
                    @foreach($popular_products as $product)
                    <div class="products-collection d-flex mb-3">
                        <div class="product-thumb me-2">
                            <img src="{{ asset('uploads/products/'.$product->image) }}" alt="{{ $product->name }}" style="width:100%;">
                        </div>
                        <div class="products-content">
                            <div class="products-title">
                                <h6>{{ $product->name }}</h6>
                            </div>
                            <div class="product-price">
                                <span>Rs: {{ $product->price }}</span>
                            </div>
                            <div class="product-icon-list">
                                <ul class="d-flex">
                                    @for($i=0;$i<5;$i++)
                                        <li><i class="bi {{ $i < $product->rating ? 'bi-star-fill' : 'bi-star' }}"></i></li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div> <!-- /Sidebar -->

            <!-- Products Grid -->
            <div class="col-lg-9 col-md-12">
                <div class="row mb-3">

                    <!-- Items per page -->
                    <div class="col-lg-6 col-md-6">
                        <div class="form_box">
                            <p class="form-text">Show on Page</p>
                            <select id="perPage" class="form-select">
                                <option value="6">6 items</option>
                                <option value="12">12 items</option>
                                <option value="24">24 items</option>
                            </select>
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="col-lg-6 col-md-6">
                        <div class="widget_search upper">
                            <form action="{{ route('shop.index') }}" method="get">
                                <input type="text" name="s" value="{{ request('s') }}" placeholder="Search Here" title="Search for:">
                                <button type="submit" class="icons"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Products Loop -->
                <div class="row products">
                    @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="single-products-box">
                            <div class="products-thumb position-relative">
                                <img src="{{ asset('uploads/products/'.$product->image) }}" alt="{{ $product->name }}">
                                @if($product->sale_price)
                                <div class="product-sale"><span> SALE </span></div>
                                @endif
                                <div class="product-thumb-icon">
                                    <a href="#"> <i class="bi bi-cart3"></i> </a>
                                    {{-- <a href="{{ route('cart.add', $product->id) }}"> <i class="bi bi-cart3"></i> </a> --}}
                                    <a href="{{ route('shop.detail', $product->slug) }}"> <i class="bi bi-suit-heart"></i> </a>
                                </div>
                            </div>
                            <div class="product-content mt-2">
                                <ul class="product-rating d-flex">
                                    @for($i=0;$i<5;$i++)
                                        <li><i class="bi {{ $i < $product->rating ? 'bi-star-fill' : 'bi-star' }}"></i></li>
                                    @endfor
                                </ul>
                                <div class="product-title">
                                    <h2>{{ $product->name }}</h2>
                                </div>
                                <div class="product-price">
                                    <p>£{{ $product->price }}
                                        @if($product->sale_price)
                                        <span>Rs: {{ $product->sale_price }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="col-lg-12">
                    <div class="pagination-menu text-center mt-4">
                        {{ $products->links() }}
                    </div>
                </div>

            </div> <!-- /Products Grid -->

        </div>

    </div>
</div>
   <!-- Get a Free Quote Section -->
    <section id="get-free-quote" class="quote-section">
        <!-- Modal -->
       <!-- Quote Modal -->
        <div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="quoteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quoteModalLabel">Get a Free Quote</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @auth
                <form action="{{ route('quotes.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                    </div>

                    <div class="form-group mt-2">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" placeholder="Enter Description" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit Quote</button>
                </form>
                @else
                    <div class="text-center">
                        <p class="mb-3">Please login to submit a free quote.</p>
                        <a href="{{ route('login') }}" class="btn btn-warning">Login Now</a>
                    </div>
                @endauth
            </div>
            </div>
        </div>
        </div>
    </section>
@endsection
