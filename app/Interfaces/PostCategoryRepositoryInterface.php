<?php

namespace App\Interfaces;

interface PostCategoryRepositoryInterface {
    public function getTopCategories(int $count);
    public function getRandomCategories(int $count);
    public function getPostCategoriesCss();
}
