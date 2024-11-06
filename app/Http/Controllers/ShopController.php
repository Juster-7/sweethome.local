<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Brand;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Product $product) {
		$last_products = $product->getLastProducts(9);
		
		return view('shop.index', compact('last_products'));
	}
	
	public function productCategory(ProductCategory $productCategory) {
		$products = $productCategory->products()->with(['productCategory'])->get();
		
		return view('shop.product-category', compact('productCategory', 'products'));
	}
	
	public function brand(Brand $brand) {
		$products = $brand->products()->with(['productCategory'])->get();
		
		return view('shop.brand', compact('brand', 'products'));
	}
	
	public function product(Product $product) {
		return view('shop.product', compact('product'));
	}	
}
