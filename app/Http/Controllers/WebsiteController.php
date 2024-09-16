<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
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
}
