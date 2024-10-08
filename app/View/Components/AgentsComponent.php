<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Vehicle;

class AgentsComponent extends Component
{

    private $vehicles;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->vehicles = Vehicle::orderBy('id', 'desc')->limit(8)->get()->load('car_model.brand');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.agents-component')->with('vehicles', $this->vehicles);
    }
}
