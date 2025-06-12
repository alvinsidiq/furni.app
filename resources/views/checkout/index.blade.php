@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Checkout</h1>
                </div>
            </div>
            <div class="col-lg-7"></div>
        </div>
    </div>
</div>

<div class="untree_co-section">
    <div class="container">
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Billing Details</h2>
                    <div class="p-3 p-lg-5 border bg-white">
                        <div class="form-group">
                            <label for="c_email" class="text-black">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="c_email" name="c_email" required>
                        </div>
                        <div class="form-group">
                            <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_fname" name="c_fname" required>
                        </div>
                        <div class="form-group">
                            <label for="c_lname" class="text-black">Last Name</label>
                            <input type="text" class="form-control" id="c_lname" name="c_lname">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 p-lg-5 border bg-white">
                        <h2 class="h3 mb-3 text-black">Your Order</h2>
                        <table class="table site-block-order-table mb-5">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td>{{ $item['name'] }} <strong class="mx-2">x</strong> {{ $item['quantity'] }}</td>
                                        <td>Rp{{ number_format($item['total'], 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Subtotal</th>
                                    <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="form-group">
                            <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Bayar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
