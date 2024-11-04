<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleApiController extends Controller
{
    public function latestStock()
    {
        return Vehicle::orderBy('id', 'desc')->limit(8)->where('api', 1)->get()->load('car_model.brand');
    }

    public function allCars($year_id, $fuel_id, $transmission_id)
    {
        $filter = [];

        if ($year_id != 0) {
            $filter['year_id'] = $year_id;
        }
        if ($fuel_id != 0) {
            $filter['fuel_id'] = $fuel_id;
        }
        if ($transmission_id != 0) {
            $filter['transmission_id'] = $transmission_id;
        }

        $vehicles = Vehicle::orderBy('id', 'desc')
            ->where($filter)
            ->get()
            ->load('car_model.brand');

        return $vehicles;
    }

    public function carsFromABrand($brand_id, $year_id, $fuel_id, $transmission_id)
    {

        $filter = [];
        if ($year_id != 0) {
            $filter['year_id'] = $year_id;
        }
        if ($fuel_id != 0) {
            $filter['fuel_id'] = $fuel_id;
        }
        if ($transmission_id != 0) {
            $filter['transmission_id'] = $transmission_id;
        }

        return Vehicle::whereHas('car_model', function ($query) use ($brand_id) {
            $query->where('brand_id', $brand_id);
        })
            ->where($filter)
            ->orderBy('id', 'desc')
            ->get()
            ->load('car_model.brand');
    }

    public function carsFromAModel($car_model_id, $year_id, $fuel_id, $transmission_id)
    {
        $filter = [];
        if ($year_id != 0) {
            $filter['year_id'] = $year_id;
        }
        if ($fuel_id != 0) {
            $filter['fuel_id'] = $fuel_id;
        }
        if ($transmission_id != 0) {
            $filter['transmission_id'] = $transmission_id;
        }

        return Vehicle::where([
            'car_model_id' => $car_model_id
        ])
            ->where($filter)
            ->orderBy('id', 'desc')
            ->get()
            ->load('car_model.brand');
    }
}
