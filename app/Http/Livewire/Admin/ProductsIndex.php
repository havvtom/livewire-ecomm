<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;

class ProductsIndex extends Component
{
    public $searchQuery;

    public function render()
    {
        $products = Product::search($this->searchQuery)->get();

        return view('livewire.admin.products-index', [
            'products' => $products
        ]);
    }
}