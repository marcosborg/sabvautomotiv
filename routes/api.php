<?php

// Brand
Route::get('brands', 'Api\V1\Admin\BrandApiController@brands');

// Car Model
Route::get('car-models/{brand_id}', 'Api\V1\Admin\CarModelApiController@carModels');
Route::get('car-model/{car_model_id}', 'Api\V1\Admin\CarModelApiController@carModel');

// Year
Route::apiResource('years', 'YearApiController');

// Fuel
Route::apiResource('fuels', 'FuelApiController');

// Transmission
Route::apiResource('transmissions', 'TransmissionApiController');

// Vehicle
Route::get('vehicles/latest-stock', 'Api\V1\Admin\VehicleApiController@latestStock');
Route::get('vehicles/all-cars/{year_id}/{fuel_id}/{transmission_id}', 'Api\V1\Admin\VehicleApiController@allCars');
Route::get('vehicles/cars-from-a-brand/{brand_id}/{year_id}/{fuel_id}/{transmission_id}', 'Api\V1\Admin\VehicleApiController@carsFromABrand');
Route::get('vehicles/cars-from-a-model/{car_model_id}/{year_id}/{fuel_id}/{transmission_id}', 'Api\V1\Admin\VehicleApiController@carsFromAModel');

// Contact
Route::apiResource('contacts', 'ContactApiController');
