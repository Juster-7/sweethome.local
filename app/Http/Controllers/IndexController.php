<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;

class IndexController extends Controller
{
	public function index(Post $post, Product $product) {
		$posts = $post->getLastPosts(7);
		$products = $product->getLastProducts(4);
		$top_posts = $post->getTopPosts(3);
        
		return view('index', compact('posts', 'products', 'top_posts'));	
	}	
}
