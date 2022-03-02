<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Cart\Contracts\CartInterface;
use App\Models\ShippingType;
use App\Cart\Cart;

class Checkout extends Component
{

    public $shippingTypes;

    public $shippingTypeId;

    public function mount()
    {
        $this->shippingTypes = ShippingType::orderBy('price', 'asc')->get();

        $this->shippingTypeId = $this->shippingTypes->first()->id;
    }

    public function getShippingTypeProperty()
    {
        return $this->shippingTypes->find( $this->shippingTypeId );
    }

    public function getTotalProperty( CartInterface $cart )
    {
        return $cart->subtotal() + $this->shippingType->price;
    }

    public function render( CartInterface $cart )
    {
        return view('livewire.checkout', [
            'cart' => $cart,
        ]);
    }
}
