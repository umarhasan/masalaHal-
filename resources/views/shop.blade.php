@extends('layouts.app')

@section('content')
<div class="shop-section">
  <div class="container py-4">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Shop</h3>

        <form class="d-flex" method="GET">
            <input type="text" name="s" value="{{ request('s') }}" class="form-control"
                placeholder="Search products...">
            <button class="btn btn-primary ms-2">Search</button>
        </form>
    </div>

    <div class="row">

        <!-- FILTER SIDEBAR -->
        <div class="col-lg-3">
            <div class="card p-3 shadow-sm">

                <h5 class="fw-bold">Filters</h5>

                <form method="GET">

                    <!-- CATEGORY FILTER -->
                    <div class="mb-3">
                        <label class="fw-semibold">Category</label>
                        <select name="category[]" class="form-select" multiple>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    @if(request()->has('category') && in_array($cat->id, request('category'))) selected @endif>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- PRICE FILTER -->
                    <div class="mb-3">
                        <label class="fw-semibold">Price Range</label>
                        <div class="d-flex gap-2">
                            <input type="number" name="min" class="form-control" placeholder="Min"
                                   value="{{ request('min') }}">
                            <input type="number" name="max" class="form-control" placeholder="Max"
                                   value="{{ request('max') }}">
                        </div>
                    </div>

                    <!-- CONDITION -->
                    <div class="mb-3">
                        <label class="fw-semibold">Condition</label>
                        <select name="condition" class="form-select">
                            <option value="">Any</option>
                            <option value="new" {{ request('condition')=='new'?'selected':'' }}>New</option>
                            <option value="used" {{ request('condition')=='used'?'selected':'' }}>Used</option>
                        </select>
                    </div>

                    <!-- SORTING -->
                    <div class="mb-3">
                        <label class="fw-semibold">Sort By</label>
                        <select name="sort" class="form-select">
                            <option value="">Latest</option>
                            <option value="price_asc"  {{ request('sort')=='price_asc'?'selected':'' }}>Price Low to High</option>
                            <option value="price_desc" {{ request('sort')=='price_desc'?'selected':'' }}>Price High to Low</option>
                            <option value="popular"    {{ request('sort')=='popular'?'selected':'' }}>Most Viewed</option>
                        </select>
                    </div>

                    <button class="btn btn-dark w-100">Apply Filters</button>
                </form>
            </div>
        </div>

        <!-- PRODUCTS LIST -->
        <div class="col-lg-9">

            <div class="row">

                @forelse($products as $p)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">

                            <a href="{{ route('shop.details', $p->slug) }}">
                                <img src="{{ $p->images->first()->image ? asset('uploads/products/'.$p->images->first()->image) : 'https://via.placeholder.com/300' }}"
                                    class="card-img-top" style="height: 220px; object-fit: cover;">
                            </a>

                            <div class="card-body">
                                <h6 class="fw-bold">{{ $p->name }}</h6>
                                <p class="text-muted">{{ Str::limit($p->description, 50) }}</p>
                                <h5 class="text-primary fw-bold">{{ number_format($p->price) }} PKR</h5>
                            </div>

                            <div class="card-footer bg-white">
                                <a href="{{ route('shop.details', $p->slug) }}" class="btn btn-primary w-100">
                                    View Details
                                </a>
                            </div>

                        </div>
                    </div>
                @empty
                    <p class="text-center">No products found.</p>
                @endforelse

            </div>

            <!-- PAGINATION -->
            <div class="mt-3">
                {{ $products->links() }}
            </div>

        </div>

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
<script>
document.getElementById('perPage')?.addEventListener('change', function(){
  const url = new URL(window.location.href);
  url.searchParams.set('perPage', this.value);
  window.location = url.toString();
});
</script>
@endsection
