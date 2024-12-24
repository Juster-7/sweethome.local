<?php

namespace App\Repositories;

use App\Interfaces\ProductCategoryRepositoryInterface;
use App\Models\ProductCategory;
class ProductCategoryRepository implements ProductCategoryRepositoryInterface
{
    public function getRootCategories() {
        return ProductCategory::where('parent_id', 0)->get();
    }
}
