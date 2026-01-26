<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LabelSize extends Component
{
    public float $w;
    public float $h;
    public float $padding;
    public float $radius;
    public float $font;
    public function __construct(float $w=58, float $h=40)
    {
        $this->w = $w;
        $this->h = $h;

        $base = min($w, $h);

        $this->padding = round($base * 0.06, 1);
        $this->radius  = round($base * 0.08, 1);
        $this->font    = round($base * 0.28, 1);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.label-size');
    }
}
