<?php

namespace App\View\Composers;

use App\Interfaces\PostCategoryRepositoryInterface;
use Illuminate\View\View;

class MenuComposer
{
	public function __construct(
		protected PostCategoryRepositoryInterface $postCategoryRepository
	) {}

    public function compose(View $view) {
       	$view->with(['menu' => $this->postCategoryRepository->getTopCategories(3)]);
    }
}
