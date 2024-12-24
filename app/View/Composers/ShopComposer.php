<?php

namespace App\View\Composers;

use App\Interfaces\ProductBrandRepositoryInterface;
use App\Interfaces\ProductCategoryRepositoryInterface;
use Illuminate\View\View;

class ShopComposer
{
	public function __construct(
		protected ProductCategoryRepositoryInterface $productCategoryRepository,
		protected ProductBrandRepositoryInterface $productBrandRepository
	) {}

    public function compose(View $view) {
       	$view->with([
				'root_categories' => $this->productCategoryRepository->getRootCategories(),
				'top_brands' => $this->productBrandRepository->getTopBrands(4),
		]);
    }
}
