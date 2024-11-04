<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarModelApiController extends Controller
{
    public function carModels($brand_id)
    {
        if ($brand_id != 0) {
            return CarModel::where('brand_id', $brand_id)->orderBy('name')->get();
        } else {
            return CarModel::orderBy('name')->get();
        }
    }

    public function carModel($car_model_id)
    {
        return CarModel::find($car_model_id);
    }
}
