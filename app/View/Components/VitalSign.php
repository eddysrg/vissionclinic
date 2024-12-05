<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VitalSign extends Component
{

    public $vitalSign;
    public $icon;
    public $value;
    public $unit;
    public $color;
    public $border;

    /**
     * Create a new component instance.
     */
    public function __construct($vitalSign, $icon, $value, $unit, $color, $border = true)
    {
        $this->vitalSign = $vitalSign;
        $this->icon = $icon;
        $this->value = $value;
        $this->unit = $unit;
        $this->color = $color;
        $this->border = $border;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.vital-sign');
    }
}
