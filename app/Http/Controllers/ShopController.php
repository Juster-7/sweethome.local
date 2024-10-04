<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class ShopController extends Controller
{
	private $category;
	private $brand;
	private $product;
	
	public function __construct() {
		$this->category = new Category;
		$this->brand = new Brand;
		$this->product = new Product;
	}
	
    public function index() {
		$root_categories = $this->category->getRootCategories();
		$top_brands = $this->brand->getTopBrands(4);
		$last_products = $this->product->getLastProducts(9);
		return view('shop.index', compact('root_categories', 'top_brands', 'last_products'));
	}
	
	public function category(Category $category) {
		$root_categories = $this->category->getRootCategories();
		$top_brands = $this->brand->getTopBrands(4);
		$products = $category->products()->with(['category'])->get();
		return view('shop.category', compact('root_categories', 'top_brands', 'category', 'products'));
	}
	
	public function brand(Brand $brand) {
		$root_categories = $this->category->getRootCategories();
		$top_brands = $this->brand->getTopBrands(4);
		$products = $brand->products()->with(['category'])->get();
		return view('shop.brand', compact('root_categories', 'top_brands', 'brand', 'products'));
	}
	
	public function product(Product $product) {
		$root_categories = $this->category->getRootCategories();
		$top_brands = $this->brand->getTopBrands(4);
		return view('shop.product', compact('root_categories', 'top_brands', 'product'));
	}
	
}
