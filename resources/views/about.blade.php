@extends('layouts.app')

@section('title', 'About')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>About Us</h1>
                        <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>
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
    <!-- End Hero Section -->

    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title">Why Choose Us</h2>
                    <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>

                    <div class="row my-5">
                        @foreach ($whyChooseUs as $item)
                            <div class="col-6 col-md-6">
                                <div class="feature">
                                    <div class="icon">
                                        <img src="{{ asset('images/' . $item->icon) }}" alt="{{ $item->title }}" class="img-fluid">
                                    </div>
                                    <h3>{{ $item->title }}</h3>
                                    <p>{{ $item->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="{{ asset('images/why-choose-us-img.jpg') }}" alt="Why Choose Us" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

    <!-- Start Team Section -->
    <div class="untree_co-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-5 mx-auto text-center">
                    <h2 class="section-title">Our Team</h2>
                </div>
            </div>

            <div class="row">
    @foreach ($teams as $team)
        <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
            <img src="{{ $team->image ? asset('storage/' . $team->image) : asset('images/person-placeholder.jpg') }}"
                 class="img-fluid mb-5"
                 alt="{{ $team->name }}">
            
            <h3>
                <a href="#">
                    <span>{{ explode(' ', $team->name)[0] }}</span> 
                    {{ explode(' ', $team->name)[1] ?? '' }}
                </a>
            </h3>
            
            <span class="d-block position mb-4">{{ $team->position }}</span>
            <p>{{ $team->description }}</p>
            <p class="mb-0">
                <a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a>
            </p>
        </div>
    @endforeach
</div>

        </div>
    </div>
    <!-- End Team Section -->

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
                            @foreach ($testimonials as $testimonial)
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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Slider -->
@endsection