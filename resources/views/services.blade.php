@extends('layouts.app')

@section('title', 'Services')

@section('content')
    <!-- Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Services</h1>
                        <p class="mb-4">We provide a variety of services to meet your needs, from design to execution.</p>
                        <p>
                            <a href="{{ route('shop') }}" class="btn btn-secondary me-2">Shop Now</a>
                            <a href="#" class="btn btn-white-outline">Explore</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <img src="{{ asset('images/couch.png') }}" class="img-fluid" alt="Couch">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="services-section py-5">
        <div class="container">
            <div class="row">
                @forelse ($services as $service)
                    <div class="col-6 col-md-6 col-lg-3 mb-4">
                        <div class="feature text-center">
                            <div class="icon mb-3">
                                <img src="{{ $service->icon ? asset('storage/icons/' . $service->icon) : asset('images/icon-placeholder.svg') }}"
                                     alt="{{ $service->title }}"
                                     class="img-fluid"
                                     style="height: 50px;"
                                     loading="lazy">
                            </div>
                            <h3 class="fw-bold">{{ $service->title }}</h3>
                            <p>{{ $service->description }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">No services available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Product Section -->
    <div class="product-section pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">Crafted with excellent material.</h2>
                    <p class="mb-4">High-quality materials and craftsmanship ensure a premium experience for your home.</p>
                    <p><a href="{{ route('shop') }}" class="btn">Explore</a></p>
                </div>

                @forelse ($furnitures as $furniture)
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <a class="product-item" href="{{ route('shop.show', $furniture->id) }}">
                            <img src="{{ $furniture->image ? asset('storage/' . $furniture->image) : asset('images/product-placeholder.png') }}"
                                 class="img-fluid product-thumbnail"
                                 alt="{{ $furniture->name }}">
                            <h3 class="product-title">{{ $furniture->name }}</h3>
                            <strong class="product-price">${{ number_format($furniture->price, 2) }}</strong>
                            <span class="icon-cross">
                                <img src="{{ asset('images/cross.svg') }}" class="img-fluid" alt="Add to cart">
                            </span>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">No furniture available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Testimonial Section -->
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
                                                <blockquote class="mb-4">
                                                    <p>“{{ $testimonial->quote }}”</p>
                                                </blockquote>
                                                <div class="author-info">
                                                    <div class="author-pic mb-2">
                                                        <img src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : asset('images/person-placeholder.jpg') }}"
                                                             alt="{{ $testimonial->name }}"
                                                             class="img-fluid rounded-circle"
                                                             style="width: 60px; height: 60px; object-fit: cover;">
                                                    </div>
                                                    <h3 class="fw-bold">{{ $testimonial->name }}</h3>
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
@endsection
