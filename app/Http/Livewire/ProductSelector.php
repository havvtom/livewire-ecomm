<?php

namespace App\Http\Livewire;

use App\Cart\Contracts\CartInterface;
use App\Models\Variation;
use Livewire\Component;

class ProductSelector extends Component
{
    public $product;

    //Variations are grouped by type. In this case the first variation is the color which is the top order that does not have a parent id
    public $initialVariation;

    public $skuVariant;

    protected $listeners = [
        'skuVariantSelected'
    ];

    public function skuVariantSelected( $variantId )
    {
        if( !$variantId ){
            $this->skuVariant = null;
            return;
        }

        $this->skuVariant = Variation::find($variantId);

    }

    public function addToCart( CartInterface $cart ){
        $cart->add( $this->skuVariant, 1 );

        $this->emit('cart.updated');

        $this->dispatchBrowserEvent('notification',[
            'body' => $this->skuVariant->product->title. ' to cart', 
            'timeout' => 3000
        ]);
    }

    public function mount()
    {
        $this->initialVariation = $this->product->variations->sortBy('order')->groupBy('type')->first();
    }

    public function render()
    {
        return view('livewire.product-selector');
    }
}
