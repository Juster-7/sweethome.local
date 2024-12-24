<?php

namespace App\Repositories;

use App\Interfaces\ProductBrandRepositoryInterface;
use App\Models\ProductBrand;
class ProductBrandRepository implements ProductBrandRepositoryInterface
{
    public function getTopBrands(int $count) {
        return ProductBrand::latest()
            ->take($count)
            ->get();
    }
}
