<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class AdminProductsCreate extends Component
{
    public function render()
    {
        return view('livewire.admin-products-create', [
            'categories' => Category::get()
        ]);
    }
}
