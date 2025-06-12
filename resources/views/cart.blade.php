@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-5 col-12">
                <div class="intro-excerpt text-center text-lg-start">
                    <h1>Cart</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th class="text-nowrap">Price</th>
                                <th class="text-nowrap">Quantity</th>
                                <th class="text-nowrap">Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cartItems as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $item['furniture']->image) }}" alt="{{ $item['furniture']->name }}" class="img-fluid" style="max-width: 70px;">
                                </td>
                                <td>
                                    <h6 class="text-black mb-0">{{ $item['furniture']->name }}</h6>
                                </td>
                                <td>${{ number_format($item['furniture']->price, 2) }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <form method="POST" action="{{ route('cart.update', $item['furniture']->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}" class="btn btn-outline-dark btn-sm">−</button>
                                        </form>

                                        <input type="text" class="form-control form-control-sm text-center" value="{{ $item['quantity'] }}" readonly style="width: 50px;">

                                        <form method="POST" action="{{ route('cart.update', $item['furniture']->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="btn btn-outline-dark btn-sm">+</button>
                                        </form>
                                    </div>
                                </td>
                                <td>${{ number_format($item['total'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item['furniture']->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">X</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Cart is empty</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Buttons & Coupon Section -->
        <div class="row gy-4">
            <div class="col-md-6">
                <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-3">
                    <a href="{{ route('cart.index') }}" class="btn btn-dark btn-sm">Update Cart</a>
                    <a href="{{ route('shop') }}" class="btn btn-outline-dark btn-sm">Continue Shopping</a>
                </div>

                <!-- Coupon -->
                <div>
                    <h4 class="text-black">Coupon</h4>
                    <p>Enter your coupon code if you have one.</p>
                    <form class="row g-2">
                        <div class="col-8">
                            <input type="text" class="form-control" placeholder="Coupon Code">
                        </div>
                        <div class="col-4">
                            <button class="btn btn-dark w-100">Apply</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Cart Totals -->
            <div class="col-md-6">
                <div class="p-4 border rounded shadow-sm bg-light">
                    <h4 class="text-uppercase mb-4">Cart Totals</h4>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <strong>${{ number_format($subtotal, 2) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <span>Total</span>
                        <strong>${{ number_format($subtotal, 2) }}</strong>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn btn-dark w-100 py-2">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
