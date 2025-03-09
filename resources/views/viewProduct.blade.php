@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Product Catalog</h1>
    
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('products.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-md-end">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Filter by Category
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('products.index') }}">All Categories</a></li>
                        @foreach(\App\Models\Category::all() as $category)
                        <li>
                            <a class="dropdown-item" href="{{ route('products.index', ['category' => $category->id]) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        @forelse($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100 product-card">
                @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                    <i class="fas fa-image fa-3x text-secondary"></i>
                </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">
                        <span class="badge bg-info">{{ $product->category->name }}</span>
                    </p>
                    <p class="card-text fw-bold text-primary">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                    
                    @if($product->quantity > 0)
                    <p class="card-text">
                        <small class="text-muted">Stock: {{ $product->quantity }} units</small>
                        <small class="text-muted">Stock: {{ $product->quantity }} units</small>
                    </p>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary">View Details</a>
                        
                        @auth
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Login to Purchase</a>
                        @endauth
                    </div>
                    @else
                    <div class="alert alert-warning">
                        Barang sudah habis, silakan tunggu hingga barang di-restock ulang
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                No products found. Please try a different search or category.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection