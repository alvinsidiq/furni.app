@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Contact</h1>
                        <p class="mb-4">Reach out to us via social media or visit our location for more information.</p>
                        <p>
                            <a href="{{ route('shop') }}" class="btn btn-secondary me-2">Shop Now</a>
                            <a href="#" class="btn btn-white-outline">Explore</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <img src="{{ asset('images/couch.png') }}" class="img-fluid" alt="Couch Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Contact Info & Social Media -->
    <div class="untree_co-section py-5">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6 text-center">
                    <h2 class="section-title">Get in Touch</h2>
                    <p class="mb-4">You can find us on the platforms below. We'd love to connect with you!</p>
                </div>
            </div>

            <div class="row justify-content-center text-center">
                <div class="col-md-4 mb-4">
                    <div class="contact-info">
                        <div class="icon mb-3">
                            <i class="bi bi-geo-alt-fill fs-2 text-primary"></i>
                        </div>
                        <p>43 Raymouth Rd. Baltemoer, London 3910</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="contact-info">
                        <div class="icon mb-3">
                            <i class="bi bi-envelope-fill fs-2 text-primary"></i>
                        </div>
                        <p>support@example.com</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="contact-info">
                        <div class="icon mb-3">
                            <i class="bi bi-telephone-fill fs-2 text-primary"></i>
                        </div>
                        <p>+1 234 567 890</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center text-center mt-5">
                <div class="col-lg-6">
                    <h3 class="mb-3">Follow Us</h3>
                    <div class="d-flex justify-content-center gap-4">
                        <a href="https://facebook.com" target="_blank" class="text-decoration-none fs-4 text-primary">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://instagram.com" target="_blank" class="text-decoration-none fs-4 text-danger">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://twitter.com" target="_blank" class="text-decoration-none fs-4 text-info">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="https://linkedin.com" target="_blank" class="text-decoration-none fs-4 text-dark">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br>
    <!-- End Contact Info & Social Media -->
@endsection
