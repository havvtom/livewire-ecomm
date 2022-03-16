<?php 

namespace App\Cart;
use App\Cart\Contracts\CartInterface;
use App\Models\Cart as ModelsCart;
use App\Models\User;
use App\Models\Variation;
use Illuminate\Session\SessionManager;
use App\Cart\Exceptions\QuantityNoLongerAvailable;

class Cart implements CartInterface
{
	protected $instance;

	public function __construct(protected SessionManager $session)
	{

	}

	public function exists()
	{
		return $this->session->has(config('cart.session.key')) && $this->instance();
	}

	//associate user to cart if user is signed in
	public function associate( User $user )
	{
		if($user){
			$this->instance->user()->associate($user);
		}

		$this->instance->save();
	}

	public function create(?User $user = null)
	{
		$instance = ModelsCart::make();

		if($user){
			$instance->user()->associate($user);
		}

		$instance->save();

		$this->session->put(config('cart.session.key'), $instance->uuid);
	}

	public function destroy()
	{
		$this->session->forget(config('cart.session.key'));

		$this->instance()->delete();
	}

	public function add( Variation $variation, $quantity = 1 )
	{
		if( $existingVariation = $this->getVariation($variation) ){
			$quantity += $existingVariation->pivot->quantity; 
		}
		$this->instance()->variations()->syncWithoutDetaching([
			$variation->id => [
				'quantity' => min($quantity, $variation->stockCount())
			]
		]);
	}

	public function remove( Variation $variation )
	{
		$this->instance()->variations()->detach($variation); 
	}

	public function changeQuantity( Variation $variation, $quantity )
	{
		$this->instance()->variations()->updateExistingPivot($variation->id, [
			'quantity' => min($quantity, $variation->stockCount())
		]);
	}

	public function syncAvailableQuantities()
	{
		$syncedQuantities = $this->instance()->variations->mapWithKeys(function ($variation) {
				$quantity = $variation->pivot->quantity > $variation->stocks->sum('amount')
					? $variation->stockCount()
					: $variation->pivot->quantity;

				return [
					$variation->id => [
						'quantity' => $quantity
					]
				];
			})
			//reject quantity equal to zero
			->reject(function($syncedQuantity){
				return $syncedQuantity['quantity'] == 0;
			})
			->toArray();
		
		$this->instance()->variations()->sync($syncedQuantities);

		$this->clearInstanceCache();
	}

	protected function clearInstanceCache()
	{
		$this->instance = null;
	}

	public function getVariation( Variation  $variation )
	{
		return $this->instance()->variations->find( $variation->id );
	}

	public function contents()
	{
		return $this->instance()->variations;
	}

	public function contentsCount()
	{
		return $this->contents()->count();
	}

	public function verifyAvailableQuantities()
	{
		$this->instance()->variations->each(function($variation){
			if($variation->pivot->quantity > $variation->stocks->sum('amount')) {
				throw new QuantityNoLongerAvailable('stock reduced');
			}
		});
	}

	public function removeAll()
	{
		$this->instance()->variations()->detach();
	}

	public function isEmpty()
	{
		return $this->contents()->count() == 0;
	}

	public function subtotal()
	{
		return $this->instance()->variations
					->reduce(function($carry, $variation){
						return $carry + ($variation->price * $variation->pivot->quantity);
					});
	}

	public function formattedSubtotal()
	{
		return money($this->subtotal());
	}

	protected function instance()
	{
		if( $this->instance ){
			return $this->instance;
		}
		return $this->instance = ModelsCart::query()
										->with(
											'variations.product', 
											'variations.ancestorsAndSelf', 
											'variations.media',
											'variations.descendantsAndSelf.stocks'
										)
										->whereUuid( $this->session
										->get(config('cart.session.key')) )
										->first();
	}
}