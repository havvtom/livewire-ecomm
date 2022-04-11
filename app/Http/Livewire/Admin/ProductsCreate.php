<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

class ProductsCreate extends Component
{
    public function render()
    {
        return view('livewire.admin.products-create', [
            'categories' => Category::get()
        ]);
    }
}
