<?php

namespace App\View\Composers;

use App\Interfaces\PostCategoryRepositoryInterface;
use Illuminate\View\View;

class StylesComposer
{
	public function __construct(
		protected PostCategoryRepositoryInterface $postCategoryRepository
	) {}

    public function compose(View $view) {
       	$view->with([
			'styles' => $this->postCategoryRepository->getPostCategoriesCss()
		]);
    }
}
