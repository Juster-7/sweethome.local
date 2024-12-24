<?php

namespace App\Repositories;

use App\Interfaces\PostCategoryRepositoryInterface;
use App\Models\PostCategory;

class PostCategoryRepository implements PostCategoryRepositoryInterface
{
    public function getTopCategories(int $count) {
        return PostCategory::withCount('posts')
            ->orderByDesc('posts_count')
            ->take($count)
            ->get();
    }

    public function getRandomCategories(int $count) {
        return  PostCategory::select('title', 'slug')
            ->distinct()
            ->inRandomOrder()
            ->take($count)
            ->get();
    }

    public function getPostCategoriesCss() {
        return  PostCategory::select('id', 'css_color')
            ->get();
    }
}
