<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Cart\Contracts\CartInterface;
use App\Models\ShippingType;
use App\Models\Order;
use App\Models\ShippingAddress;
use App\Cart\Cart;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;

class Checkout extends Component
{

    public $shippingTypes;

    protected $shippingAddress;

    public $shippingTypeId;

    public $userShippingAddressId;

    public $accountForm = [
        'email' => ''
    ];

    public $shippingForm = [
        'address' => '',
        'city' => '',
        'postcode' => ''
    ];

    protected $validationAttributes = [
        'accountForm.email' => 'email address',
        'shippingForm.address' => 'shipping address',
        'shippingForm.city' => 'shipping city ',
        'shippingForm.postcode' => 'shipping postal code',
    ];

    protected $messages = [
        'accountForm.email.unique' => 'Seems you already have an account. Please sign in to place an order.',
        'shippingForm.address.required' => 'Your :attribute is required'
    ];

    public function checkout( CartInterface $cart )
    {
        $this->validate();

        //when user is signed in associate the address to the user
       
        $this->shippingAddress = ShippingAddress::query();

        //Check if there is an authenticated user
        if( auth()->user() ){
            $this->shippingAddress = $this->shippingAddress->whereBelongsTo(auth()->user());
        }

        ($this->shippingAddress = $this->shippingAddress->firstOrCreate($this->shippingForm))
            ?->user()
            ->associate(auth()->user())
            ->save();

        $order = Order::make(array_merge($this->accountForm, [
            'subtotal' => $cart->subtotal()
        ]));
        
        $order->user()->associate( auth()->user() );

        $order->shippingType()->associate( $this->shippingType );

        $order->shippingAddress()->associate( $this->shippingAddress );

        $order->save();

        $order->variations()->attach(
            $cart->contents()->mapWithKeys( function( $variation ){
                return [
                    $variation->id => [
                                    'quantity' => $variation->pivot->quantity
                                ]
                ];
            } )
            ->toArray()
        );

        $cart->contents()->each(function($variation){
            $variation->stocks()->create([
                'amount' => 0 - $variation->pivot->quantity
            ]);
        });

        //Remove cart products
        $cart->removeAll();

        //Send email
        Mail::to($order->email)->send( new OrderCreated($order) );

        //Delete cart session after checkout
        $cart->destroy();

        //check if user is signed in
        if( !auth()->user() ){
            return redirect()->route('orders.confirmation', $order);
        }

        return redirect()->route('orders');
    }

    public function rules()
    {
        return [
            'accountForm.email' => 'required|email|max:255|unique:users,email'.(auth()->user() ? ',' . auth()->user()->id : ''),
            'shippingForm.address' => 'required|max:255',
            'shippingForm.city' => 'required|max:255',
            'shippingForm.postcode' => 'required|max:255',
            'shippingTypeId' => 'required|exists:shipping_types,id'
        ];
    }

    public function mount()
    {
        $this->shippingTypes = ShippingType::orderBy('price', 'asc')->get();

        $this->shippingTypeId = $this->shippingTypes->first()->id;

        if($user = auth()->user()){
            $this->accountForm['email'] = $user->email;
        }
    }

    public function updatedUserShippingAddressId($id)
    {
        if(!$id){
            return;
        }

        $this->shippingForm = $this->userShippingAddresses->find($id)
            ->only('address', 'city', 'postcode');
    }

    public function getUserShippingAddressesProperty()
    {
        return auth()->user()?->shippingAddresses;
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
