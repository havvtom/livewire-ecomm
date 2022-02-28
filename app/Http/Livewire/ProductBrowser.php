<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductBrowser extends Component
{
    public $category;

    public $queryFilters = [];

    public function mount()
    {
        $this->queryFilters = $this->category->products->pluck('variations')->flatten()
        ->groupBy('type')
        ->keys()
        ->mapWithKeys( fn ($key) => [ $key => [] ] )
        ->toArray();
    }

    public function render()
    {   
        //Search

        $filters = collect($this->queryFilters)->filter( fn($filter) => !empty($filter) )
                        ->recursive()
                        ->map(function ($value, $key){
                                return $value->map(fn ($value) => $key . ' = "' . $value . '"' );
                            })
                        ->flatten()
                        ->join(' AND ');

        // dd($filters);

        $search = Product::search('', function ($meilisearch, string $query, array $options) {
            // $options['filter'] = 'category_ids = ' . $this->category->id;

            $options['facetsDistribution'] = ['Size', 'Color'];

            return $meilisearch->search($query, $options);

        })->raw();
        
        $products = $this->category->products->find(collect($search['hits'])->pluck('id'));

        return view('livewire.product-browser', [
            'products' => $products,
            'filters' => $search['facetsDistribution']
        ]);
    }
}
