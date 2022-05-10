<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductsCreate extends Component
{
    public $title;
    public $addedCategories;
    public $price;
    public $description; 

    public function addProduct()
    {
        //Validation
        $validatedAttributes = $this->validate([
            'title' => 'required|min:3|string|unique:products,title',
            'description' => 'required|min:3|string',
            'price' => 'required|integer'
        ]);

        //Add the slug field
        $validatedAttributes['slug'] = Str::slug($validatedAttributes['title']);

        //Add the record to the database
        $product = Product::create($validatedAttributes);
    }

    public function render()
    {
        return view('livewire.admin.products-create', [
            'categories' => Category::get()
        ]);
    }
}
