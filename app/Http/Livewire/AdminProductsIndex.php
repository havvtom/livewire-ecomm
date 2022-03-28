<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class AdminProductsIndex extends Component
{
    public $searchQuery = '';

    public function render()
    {
        $products = Product::search($this->searchQuery)->get();

        return view('livewire.admin-products-index', [
            'products' => $products
        ]);
    }
}
