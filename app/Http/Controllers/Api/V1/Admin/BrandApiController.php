<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Brand;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BrandApiController extends Controller
{
    use MediaUploadingTrait;

    public function brands()
    {
        return Brand::orderBy('name')->get();
    }
}
