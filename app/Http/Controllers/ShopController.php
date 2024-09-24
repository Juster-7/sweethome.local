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
	
	public function category($slug) {
		$root_categories = $this->category->getRootCategories();
		$top_brands = $this->brand->getTopBrands(4);
		$category = $this->category->getCategoryBySlug($slug);
		$products = $category->products()->get();
		//$products = $this->product->getProductsByCategoryId($category->id);
		return view('shop.category', compact('root_categories', 'top_brands', 'category', 'products'));
	}
	
	public function brand($slug) {
		$root_categories = $this->category->getRootCategories();
		$top_brands = $this->brand->getTopBrands(4);
		$brand = $this->brand->getBrandBySlug($slug);
		$products = $brand->products()->get();
		return view('shop.brand', compact('root_categories', 'top_brands', 'brand', 'products'));
	}
	
	public function product($slug) {
		$root_categories = $this->category->getRootCategories();
		$top_brands = $this->brand->getTopBrands(4);
		$product = $this->product->getProductBySlug($slug);
		return view('shop.product', compact('root_categories', 'top_brands', 'product'));
	}
	
}
