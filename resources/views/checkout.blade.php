@extends('layouts.app')

@section('title', 'Services')

@section('content')	
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Services</h1>
                    <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>
                    <p><a href="{{ route('shop') }}" class="btn btn-secondary me-2">Shop Now</a><a href="#" class="btn btn-white-outline">Explore</a></p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="hero-img-wrap">
                    <img src="{{ asset('images/couch.png') }}" class="img-fluid" alt="Hero Image">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Services Section -->
<div class="services-section">
    <div class="container">
        <div class="row my-5">
            @forelse ($services as $service)
                <div class="col-6 col-md-6 col-lg-3 mb-4">
                    <div class="feature text-center">
                        <div class="icon mb-3">
                            @if ($service->icon)
                                <img src="{{ asset('icons/' . $service->icon) }}" alt="{{ $service->title }}" class="img-fluid" style="width: 40px; height: 40px;">
                            @else
                                <img src="{{ asset('images/icon-placeholder.svg') }}" alt="{{ $service->title }}" class="img-fluid" style="width: 40px; height: 40px;">
                            @endif
                        </div>
                        <h3>{{ $service->title }}</h3>
                        <p>{{ $service->description }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p>No services available.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
<!-- End Services Section -->

<!-- Start Product Section -->
<div class="product-section pt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                <h2 class="mb-4 section-title">Crafted with excellent material.</h2>
                <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>
                <p><a href="{{ route('shop') }}" class="btn">Explore</a></p>
            </div>
            @forelse ($furnitures as $furniture)
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="{{ route('shop.show', $furniture->id) }}">
                        <img src="{{ $furniture->image ? asset('storage/' . $furniture->image) : asset('images/product-placeholder.png') }}" class="img-fluid product-thumbnail">
                        <h3 class="product-title">{{ $furniture->name }}</h3>
                        <strong class="product-price">${{ number_format($furniture->price, 2) }}</strong>
                        <span class="icon-cross">
                            <img src="{{ asset('images/cross.svg') }}" class="img-fluid">
                        </span>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <p>No furniture available.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
<!-- End Product Section -->

<!-- Start Testimonial Slider -->
<div class="testimonial-section before-footer-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center">
                <h2 class="section-title">Testimonials</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="testimonial-slider-wrap text-center">
                    <div id="testimonial-nav">
                        <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                        <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                    </div>

                    <div class="testimonial-slider">
                        @forelse ($testimonials as $testimonial)
                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">
                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>“{{ $testimonial->quote }}”</p>
                                            </blockquote>
                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : asset('images/person-placeholder.jpg') }}" alt="{{ $testimonial->name }}" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">{{ $testimonial->name }}</h3>
                                                <span class="position d-block mb-3">{{ $testimonial->position }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">
                                        <p>No testimonials available.</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Testimonial Slider -->
@endsection
