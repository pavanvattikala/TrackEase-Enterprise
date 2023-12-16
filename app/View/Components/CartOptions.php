<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartOptions extends Component
{


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $icon,
        public string $name,
        public string $shortcut
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() : View
    {
        return view('components.cart-options');
    }
}
