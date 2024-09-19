@extends('layouts.website')
@section('content')
<div class="container" style="margin-top: 150px;">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Results</h2>
    </div><!-- End Section Title -->
    <div class="row">
        <div class="col-md-9">
            <div class="row gy-5">

                @foreach ($vehicles as $vehicle)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                        <div class="pic"><img src="{{ $vehicle->photos[0]->getUrl() }}" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>{{ $vehicle->car_model->brand->name }} {{ $vehicle->car_model->name }}</h4>
                            <span>{{ $vehicle->type }}</span>
                            <h5>{{ $vehicle->price }}€</h5>
                            <div class="d-grid gap-2">
                                <a href="/vehicle/{{ $vehicle->id }}/{{ Str::slug($vehicle->car_model->brand->name . ' ' . $vehicle->car_model->name . ' ' . $vehicle->type) }}" class="btn btn-theme btn-sm">View</a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->
                @endforeach


            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>
</div>
@endsection
