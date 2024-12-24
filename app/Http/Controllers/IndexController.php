<?php

namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;

class IndexController extends Controller
{
	public function index(
            PostRepositoryInterface $postRepository,
            ProductRepositoryInterface $productRepository
    ) {
		$posts = $postRepository->getLastPosts(7);
		$top_posts = $postRepository->getTopPosts(3);
		$products = $productRepository->getLastProducts(4);

		return view('index', compact('posts', 'products', 'top_posts'));
	}
}
