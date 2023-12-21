<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SaleItemComponent extends Component
{
    public $item;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($saleItem)
    {
        //
        $this->item =$saleItem;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sale-item-component');
    }
}
