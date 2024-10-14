<?php

namespace App\View\Composers;

use App\Models\ProductCategory;
use App\Models\Brand;
use Illuminate\View\View;

class ShopComposer
{
	public function __construct(
		protected ProductCategory $productCategory,
		protected Brand $brand
	) {}
	
    public function compose(View $view) {
       	$view->with([
				'root_categories' => $this->productCategory->getRootCategories(),
				'top_brands' => $this->brand->getTopBrands(4),
		]);
    }
}
