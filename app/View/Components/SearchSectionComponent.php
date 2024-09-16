<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Brand;
use App\Models\CarModel;

class SearchSectionComponent extends Component
{

    private $brands;
    private $car_models;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->brands = Brand::orderBy('name')->get();
        $this->car_models = CarModel::orderBy('name')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-section-component')->with([
            'brands' => $this->brands,
            'car_models' => $this->car_models
        ]);
    }
}
