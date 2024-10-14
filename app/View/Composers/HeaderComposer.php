<?php

namespace App\View\Composers;

use App\Models\Post;
use App\Models\Cart;
use Illuminate\View\View;

class HeaderComposer
{
	private $post;
	private $cart;
	
	public function __construct(Post $post, Cart $cart) {
		$this->post = $post;
		$this->cart = $cart;
	}
	
    public function compose(View $view) {
       	$view->with([
			'last_posts' => $this->post->getLastPosts(4),
			'cart_count' => $this->cart->getCart()->getCount(),
		]);
    }
}
