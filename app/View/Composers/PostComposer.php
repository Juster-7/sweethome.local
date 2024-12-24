<?php

namespace App\View\Composers;

use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\PostCategoryRepositoryInterface;
use Illuminate\View\View;

class PostComposer
{
	public function __construct(
		protected PostRepositoryInterface $postRepository,
		protected PostCategoryRepositoryInterface $postCategoryRepository
	) {}

    public function compose(View $view) {
       	$view->with([
				'top_posts' => $this->postRepository->getTopPosts(4),
				'top_categories' => $this->postCategoryRepository->getTopCategories(5),
				'all_categories' => $this->postCategoryRepository->getRandomCategories(10),
			]);
    }
}
