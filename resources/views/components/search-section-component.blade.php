<section id="search-section">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <!-- Added mx-auto class here -->
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <select name="" class="form-control">
                            <option value="0">All brands</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <select name="" class="form-control">
                            <option value="0">All models</option>
                            @foreach ($car_models as $car_model)
                                <option value="{{ $car_model->id }}">{{ $car_model->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <button type="submit" class="btn btn-theme form-control">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>