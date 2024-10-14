<?php

namespace App\View\Composers;

use App\Models\ProductCategory;
use App\Models\Brand;
use Illuminate\View\View;

class ShopComposer
{
	private $productCategory;
	private $brand;
	
	public function __construct(ProductCategory $productCategory, Brand $brand) {
		$this->productCategory = $productCategory;
		$this->brand = $brand;
	}
	
    public function compose(View $view) {
       	$view->with([
				'root_categories' => $this->productCategory->getRootCategories(),
				'top_brands' => $this->brand->getTopBrands(4),
		]);
    }
}
