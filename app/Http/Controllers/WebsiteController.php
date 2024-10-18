<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Fuel;
use App\Models\Transmission;
use App\Models\Year;
use Illuminate\Http\Request;
use App\Models\ContentPage;
use Illuminate\Support\Str;

class WebsiteController extends Controller
{

    public function index()
    {
        return view('website.index');
    }

    public function vehicle($vehicle_id, $slug)
    {

        $vehicle = Vehicle::find($vehicle_id)->load('car_model.brand');

        return view('website.vehicle', compact('vehicle'));
    }

    public function page($cms_id, $slug)
    {

        $page = ContentPage::find($cms_id);

        return view('website.page', compact('page'));
    }

    public function vehicles($brand_id, $car_model_id, $brand_slug, $car_model_slug)
    {
        session()->put([
            'brand_id' => $brand_id,
            'car_model_id' => $car_model_id
        ]);

        return view('website.vehicles', compact('brand_id', 'car_model_id'));
    }

    public function ajax($brand_id, $car_model_id, $year_id, $fuel_id, $transmission_id)
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

        if ($brand_id == 0 && $car_model_id == 0) {
            //ALL CARS
            $vehicles = Vehicle::orderBy('id', 'desc')
                ->where($filter)
                ->get()
                ->load('car_model.brand');
            $models = CarModel::orderBy('name')->get();
        } elseif ($brand_id != 0 && $car_model_id == 0) {
            //ALL CARS FROM A BRAND
            $vehicles = Vehicle::whereHas('car_model', function ($query) use ($brand_id) {
                $query->where('brand_id', $brand_id);
            })
                ->where($filter)
                ->orderBy('id', 'desc')
                ->get()
                ->load('car_model.brand');
            $models = CarModel::where('brand_id', $brand_id)->orderBy('name')->get();
        } elseif ($car_model_id != 0) {
            $model = CarModel::find($car_model_id);
            $brand_id = $model->brand_id;
            $vehicles = Vehicle::where([
                'car_model_id' => $car_model_id
            ])
                ->where($filter)
                ->orderBy('id', 'desc')
                ->get()
                ->load('car_model.brand');
            $models = CarModel::where('brand_id', $brand_id)->orderBy('name')->get();
        } else {
            //CARS FROM A MODEL
            $vehicles = Vehicle::where([
                'car_model_id' => $car_model_id
            ])
                ->where($filter)
                ->orderBy('id', 'desc')
                ->get()
                ->load('car_model.brand');
            $models = CarModel::orderBy('name')->get();
        }

        $brands = Brand::orderBy('name')->get();
        $years = Year::orderBy('number', 'desc')->get();
        $fuels = Fuel::orderBy('name')->get();
        $transmissions = Transmission::orderBy('name')->get();

        $brand = Brand::find($brand_id);
        $car_model = CarModel::find($car_model_id);
        $url = '/vehicles/' . $brand_id . '/' . $car_model_id . '/' . ($brand ? Str::slug($brand->name) : 'all-brands') . '/' . ($car_model ? Str::slug($car_model->name) : 'all-models');

        return view('website.ajax', compact('vehicles', 'brands', 'models', 'years', 'fuels', 'transmissions', 'brand_id', 'car_model_id', 'year_id', 'fuel_id', 'transmission_id', 'url'));
    }
}
