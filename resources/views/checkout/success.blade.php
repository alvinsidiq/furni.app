@extends('layouts.app')

@section('title', 'Checkout Sukses')

@section('content')
<div class="container text-center py-5">
    <h1>Terima kasih atas pesanan Anda!</h1>
    <p>Pesanan Anda telah berhasil diproses.</p>
    <a href="{{ route('home') }}" class="btn btn-primary mt-4">Kembali ke Beranda</a>
</div>
<br><br><br>
@endsection
