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
    public function __construct(string $name)
    {
        $size=$this->parseLabelSize($name);

        $this->w = $size['w'];
        $this->h = $size['h'];

        $base = min($this->w, $this->h);

        $this->padding = round($base * 0.06, 1);
        $this->radius  = round($base * 0.08, 1);
        $this->font    = round($base * 0.28, 1);
    }

    public function parseLabelSize(string $name): ?array
    {
        // приводим всё к нижнему регистру
        $name = mb_strtolower($name);
    
        // заменяем разные символы на x
        $name = str_replace(['×', '*', 'х'], 'x', $name);
    
        // ищем формат число x число
        if (preg_match('/(\d{2,4})\s*x\s*(\d{2,4})/', $name, $m)) {
            return [
                'w' => (int) $m[1],
                'h' => (int) $m[2],
            ];
        }
    
        return [
            'w' => 58,
            'h' => 40,
        ];;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.label-size');
    }
}
