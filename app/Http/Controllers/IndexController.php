<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Product;

class IndexController extends Controller
{
	public function __construct(
		protected Post $post,
		protected Product $product
	) {}

	public function index() {
		$posts = $this->post->getLastPosts(7);
		$products = $this->product->getLastProducts(4);
		$top_posts = $this->post->getTopPosts(3);
        
		return view('index', compact('posts', 'products', 'top_posts'));	
	}	
}
