@extends('layouts.website')
@section('content')
<section id="vehicle">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- Main Slider -->
                <div class="swiper main-swiper">
                    <div class="swiper-wrapper">
                        <!-- Main Slides -->
                        @foreach ($vehicle->photos as $photo)
                        <div class="swiper-slide">
                            <!-- Swiper Zoom Container -->
                            <div class="swiper-zoom-container">
                                <img src="{{ $photo->getUrl() }}" class="img-fluid">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Navigation Buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>

                <!-- Thumbnail Slider -->
                <div class="swiper thumbnail-swiper mt-3">
                    <div class="swiper-wrapper">
                        <!-- Thumbnail Slides -->
                        @foreach ($vehicle->photos as $photo)
                        <div class="swiper-slide">
                            <img src="{{ $photo->getUrl() }}" class="img-fluid thumbnail-img">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Additional content can go here -->
                <div class="vehicle-info">
                    <!-- Model and Year -->
                    <h2>{{ $vehicle->car_model->brand->name }} {{ $vehicle->car_model->name }} - {{ $vehicle->year->number }}</h2>

                    <!-- Price -->
                    <p><strong>Price:</strong> {{ number_format($vehicle->price, 2) }}€</p>

                    <!-- Basic Info -->
                    <ul class="list-unstyled">
                        <li><strong>Fuel:</strong> {{ $vehicle->fuel->name }}</li>
                        <li><strong>Transmission:</strong> {{ $vehicle->transmission->name }}</li>
                        <li><strong>Type:</strong> {{ $vehicle->type }}</li>
                        <li><strong>Bodywork:</strong> {{ $vehicle->bodywork }}</li>
                    </ul>

                    <!-- Performance -->
                    <h4>Performance</h4>
                    <ul class="list-unstyled">
                        <li><strong>Power:</strong> {{ $vehicle->power }}</li>
                        <li><strong>Cylinder:</strong> {{ $vehicle->cylinder }}</li>
                        <li><strong>Weight:</strong> {{ $vehicle->weight }} kg</li>
                    </ul>

                    <!-- Vehicle Details -->
                    <h4>Vehicle Details</h4>
                    <ul class="list-unstyled">
                        <li><strong>License Plate:</strong> {{ $vehicle->license_plate }}</li>
                        <li><strong>Kilometers:</strong> {{ $vehicle->quilometers }}</li>
                        <li><strong>Colour:</strong> {{ $vehicle->colour }}</li>
                        <li><strong>VAT/Margin:</strong> {{ $vehicle->vat_margin }}</li>
                    </ul>

                    <!-- Consumption -->
                    <h4>Fuel Consumption</h4>
                    <ul class="list-unstyled">
                        <li><strong>Average Consumption:</strong> {{ $vehicle->average_consumption }}</li>
                        <li><strong>City Consumption:</strong> {{ $vehicle->consumption_city }}</li>
                        <li><strong>Highway Consumption:</strong> {{ $vehicle->highway_consumption }}</li>
                        <li><strong>CO2 Emissions:</strong> {{ $vehicle->co_2_emissions }}</li>
                    </ul>

                    
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    #vehicle {
        padding-top: 150px;
    }
    /* Main Swiper */
    .main-swiper {
        width: 100%;
        height: auto;
    }

    .main-swiper .swiper-slide {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Thumbnail Swiper */
    .thumbnail-swiper {
        width: 100%;
        height: 100px;
        /* Adjust the height of the thumbnail swiper */
    }

    .thumbnail-swiper .swiper-slide {
        width: auto;
        /* Adjust the width of the thumbnails */
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0.4;
        /* Default opacity */
    }

    .thumbnail-swiper .swiper-slide-thumb-active {
        opacity: 1;
        /* Opacity for active thumbnail */
    }

    /* Adjust image styles */
    .main-swiper .swiper-slide img {
        max-width: 100%;
        height: auto;
    }

    .thumbnail-img {
        max-width: 100%;
        height: auto;
    }

    /* Custom Swiper Styles */
    /* Pagination Dots */
    .swiper-pagination-bullet {
        background-color: #cc6600;
        /* Custom color for pagination dots */
    }

    .swiper-pagination-bullet-active {
        background-color: #cc6600;
        /* Custom color for the active pagination dot */
    }

    /* Navigation Arrows */
    .swiper-button-next,
    .swiper-button-prev {
        color: #cc6600;
        /* Custom color for navigation arrows */
    }

    /* Adjust the size of the navigation arrows */
    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 20px;
    }

</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Initialize the thumbnail swiper
    const thumbnailSwiper = new Swiper('.thumbnail-swiper', {
        spaceBetween: 10
        , slidesPerView: 4, // Number of thumbnails visible
        freeMode: true
        , watchSlidesVisibility: true
        , watchSlidesProgress: true
    , });

    // Initialize the main swiper and link it with the thumbnail swiper
    const mainSwiper = new Swiper('.main-swiper', {
        loop: true
        , spaceBetween: 10,

        // Enable Zoom
        zoom: {
            maxRatio: 5, // Maximum zoom level
        },

        // Pagination
        pagination: {
            el: '.swiper-pagination'
            , clickable: true
        , },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next'
            , prevEl: '.swiper-button-prev'
        , },

        // Link with the thumbnail swiper
        thumbs: {
            swiper: thumbnailSwiper
        , }
    , });

</script>
@endsection