@extends('layouts.app')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-5">
            @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
            @else
            <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 400px;">
                <i class="fas fa-image fa-5x text-secondary"></i>
            </div>
            @endif
        </div>
        
        <div class="col-md-7">
            <h1 class="mb-3">{{ $product->name }}</h1>
            
            <div class="mb-3">
                <span class="badge bg-info">{{ $product->category->name }}</span>
            </div>
            
            <h2 class="text-primary mb-4">Rp. {{ number_format($product->price, 0, ',', '.') }}</h2>
            
            <div class="mb-4">
                <h5>Stock Status:</h5>
                @if($product->quantity > 0)
                <p class="text-success">
                    <i class="fas fa-check-circle"></i> In Stock ({{ $product->quantity }} units available)
                </p>
                @else
                <p class="text-danger">
                    <i class="fas fa-times-circle"></i> Out of Stock
                </p>
                @endif
            </div>
            
            @if($product->quantity > 0)
            @auth
            <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-4">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="quantity" class="col-form-label">Quantity:</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" max="{{ $product->quantity }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary mb-4">Login to Purchase</a>
            @endauth
            @else
            <div class="alert alert-warning mb-4">
                Barang sudah habis, silakan tunggu hingga barang di-restock ulang
            </div>
            @endif
        </div>
    </div>
</div>
@endsection