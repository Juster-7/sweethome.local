<?php

namespace App\Interfaces;

interface ProductBrandRepositoryInterface {
    public function getTopBrands(int $count);
}
