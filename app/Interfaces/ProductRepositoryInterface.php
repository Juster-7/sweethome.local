<?php

namespace App\Interfaces;

interface ProductRepositoryInterface {
    public function getLastProducts(int $count);
}
