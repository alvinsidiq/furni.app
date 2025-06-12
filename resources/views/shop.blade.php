@extends('layouts.app')

@section('title', 'Shop')

@section('content')	
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Shop</h1>
                </div>
            </div>
            <div class="col-lg-7"></div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row">
            @forelse ($furnitures as $furniture)
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <div class="product-item position-relative">
                        <a href="">
                            <img src="{{ $furniture->image ? asset('storage/' . $furniture->image) : asset('images/product-placeholder.png') }}" class="img-fluid product-thumbnail">
                            <h3 class="product-title">{{ $furniture->name }}</h3>
                            <strong class="product-price">${{ number_format($furniture->price, 2) }}</strong>
                        </a>

                        {{-- Tombol Add to Cart --}}
                        <form action="{{ route('cart.add', $furniture->id) }}" method="POST" 
                              class="position-absolute bottom-0 start-50 translate-middle-x" 
                              style="z-index: 2;">
                            @csrf
                            <button type="submit" class="border-0 bg-transparent p-0 m-0">
                                <span class="icon-cross">
                                    <img src="{{ asset('images/cross.svg') }}" class="img-fluid" alt="Add to Cart">
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p>No furniture available.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
