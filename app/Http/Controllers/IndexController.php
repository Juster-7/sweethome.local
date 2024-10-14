<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Product;

class IndexController extends Controller
{
	private $post;
	private $product;
	
	public function __construct(Post $post, Product $product) {
		$this->post = $post;
		$this->product = $product;
	}

	public function index() {
		$posts = $this->post->getLastPosts(7);
		$products = $this->product->getLastProducts(4);
        
		return view('index', compact('posts', 'products'));	
	}	
}
