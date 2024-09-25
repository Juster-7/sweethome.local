<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
	private $cart;
	
	public function __construct() {
		$this->cart = new Cart;
	}
    
	public function index(Request $request) {
        $products = $this->cart->getCart()->products;            
        
		return view('cart.index', compact('products'));
    }
	
	public function checkout() {
		return view('cart.checkout');
	}
	
	public function add($product_id) {
        $quantity = request()->input('quantity') ?? 1;
        $this->cart->getCart()->changeProductQuantity($product_id, $quantity);
				
        return back();
    }
	
	public function increase($product_id, $quantity = 1) {
		$this->cart->getCart()->changeProductQuantity($product_id, $quantity);
		return redirect()->route('cart.index');
	}

	public function decrease($product_id, $quantity = -1) {
		$this->cart->getCart()->changeProductQuantity($product_id, $quantity);		
		return redirect()->route('cart.index');
	}

	public function remove($product_id, $quantity = -1) {
		$this->cart->getCart()->remove($product_id);		
		return redirect()->route('cart.index');
	}		
}
