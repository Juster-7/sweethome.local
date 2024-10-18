<?php

namespace App\View\Composers;

use App\Models\Post;
use App\Models\Cart;
use Illuminate\View\View;

class HeaderComposer
{
	public function __construct(
		protected Post $post,
		protected Cart $cart
	) {}
	
    public function compose(View $view) {
       	$view->with([
			'last_posts' => $this->post->getLastPosts(4),
			'cart_count' => $this->cart->getCart()->getProductsWithQuantityCount(),
		]);
    }
}
