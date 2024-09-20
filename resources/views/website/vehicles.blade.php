@extends('layouts.website')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('content')
<section id="agents" class="agents section" style="padding-top: 150px;">
    <div class="container">
        <div class="container section-title" data-aos="fade-up" style="padding-bottom: 0px;">
            <h2>Results</h2>
        </div>
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
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <h5 class="card-header text-bg-theme text-center">Filter</h5>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Brand</label>
                            <select id="brand_id" class="form-select select2">
                                <option value="0">All Brands</option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Model</label>
                            <select id="car_model_id" class="form-select select2">
                                <option value="0">All Models</option>
                                @foreach ($models as $model)
                                <option value="{{ $model->id }}">{{ $model->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Year</label>
                            <select id="year_id" class="form-select select2">
                                <option value="0">All Years</option>
                                @foreach ($years as $year)
                                <option value="{{ $year->id }}">{{ $year->number }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Fuel</label>
                            <select id="fuel_id" class="form-select select2">
                                <option value="0">All Fuels</option>
                                @foreach ($fuels as $fuel)
                                <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Transmission</label>
                            <select id="transmission_id" class="form-select select2">
                                <option value="0">All Transmissions</option>
                                @foreach ($transmissions as $transmission)
                                <option value="{{ $transmission->id }}">{{ $transmission->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button id="reset_button" class="btn btn-danger mt-3">Reset Filters</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Inicializar select2
        $('.select2').select2({
            theme: 'bootstrap-5'
        });

    });

</script>

@endsection
