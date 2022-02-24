<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductBrowser extends Component
{
    public $category;

    public function render()
    {
        return view('livewire.product-browser', [
            'products' => Product::get()
        ]);
    }
}
