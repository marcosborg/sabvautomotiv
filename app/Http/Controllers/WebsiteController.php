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

        if ($brand_id == 0) {
            //ALL CARS
            $vehicles = Vehicle::orderBy('id', 'desc')->get()->load('car_model.brand');
        } elseif ($brand_id != 0 && $car_model_id == 0) {
            //ALL CARS FROM A BRAND
            $vehicles = Vehicle::whereHas('car_model', function ($query) use ($brand_id) {
                $query->where('brand_id', $brand_id);
            })->orderBy('id', 'desc')->get()->load('car_model.brand');
        } else {
            //CARS FROM A MODEL
            $vehicles = Vehicle::where([
                'car_model_id' => $brand_id
            ])->orderBy('id', 'desc')->get()->load('car_model.brand');
        }

        $brands = Brand::all();
        $models = CarModel::all();
        $years = Year::all();
        $fuels = Fuel::all();
        $transmissions = Transmission::all();

        return view('website.vehicles', compact('vehicles', 'brands', 'models', 'years', 'fuels', 'transmissions'));
    }
}
