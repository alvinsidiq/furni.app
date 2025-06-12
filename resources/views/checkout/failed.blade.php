@extends('layouts.app')
@section('title', 'Pembayaran Gagal')
@section('content')
<div class="container text-center py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <i class="fas fa-times-circle text-danger" style="font-size: 4rem;"></i>
                    </div>
                    <h2 class="text-danger mb-3">Pembayaran Gagal</h2>
                    <p class="text-muted mb-4">
                        Maaf, pembayaran Anda tidak dapat diproses. 
                        Silakan coba lagi atau hubungi customer service kami.
                    </p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('cart.index') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-cart me-2"></i>Kembali ke Keranjang
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-home me-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection