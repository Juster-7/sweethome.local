<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductBrand;

class ShopController extends Controller
{
    public function index(ProductRepositoryInterface $productRepository) {
		$last_products = $productRepository->getLastProducts(9);

		return view('shop.index', compact('last_products'));
	}

	public function productCategory(ProductCategory $productCategory) {
		$products = $productCategory->products()->with(['productCategory'])->get();

		return view('shop.product-category', compact('productCategory', 'products'));
	}

	public function productBrand(ProductBrand $productBrand) {
		$products = $productBrand->products()->with(['productCategory'])->get();

		return view('shop.product-brand', compact('productBrand', 'products'));
	}

	public function product(Product $product) {
		$product->loadCount(['comments']);
		$comments = $product->comments()->with(['children', 'user'])->whereNull('parent_id')->get();

		return view('shop.product', compact('product', 'comments'));
	}
}
