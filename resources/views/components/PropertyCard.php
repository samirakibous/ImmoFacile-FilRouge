<?php
namespace App\View\Components;

use App\Models\Property;
use Illuminate\View\Component;

class PropertyCard extends Component
{
    public $property;

   
    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.property-card');
    }
}
