<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class Cart extends Model
{	
	public function products() {
		return $this->belongsToMany(Product::class)->withPivot('quantity');
	}
	
	public function getCart() {
		$cart_id = request()->cookie('cart_id');        
		if(!empty($cart_id)) {
			$cart = Cart::find($cart_id);
			if(!$cart) {
				$cart = Cart::create();
			}
		} else $cart = Cart::create();
		
		Cookie::queue('cart_id', $cart->id, 525600);
		return $cart;
	}
	
	public function changeProductQuantity($product_id, $quantity): void {
		if($quantity != 0){
			if ($this->products->contains($product_id)) {
				$pivotRow = $this->products()->where('product_id', $product_id)->first()->pivot;
				$quantity = $pivotRow->quantity + $quantity;
				if($quantity>0)
					$pivotRow->update(['quantity' => $quantity]);
				else
					$pivotRow->delete();
			} else {
				if($quantity>0) $this->products()->attach($product_id, ['quantity' => $quantity]);
			}
		}
	}
	
	public function remove($product_id) {
		$this->products()->detach($product_id);
	}
}
