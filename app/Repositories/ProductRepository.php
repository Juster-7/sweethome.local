<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getLastProducts(int $count) {
        return Product::latest('id')
            ->with(['productCategory'])
            ->take($count)
            ->get();
    }
}
