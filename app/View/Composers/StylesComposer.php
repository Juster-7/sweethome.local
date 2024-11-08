<?php

namespace App\View\Composers;

use App\Models\PostCategory;
use Illuminate\View\View;

class StylesComposer
{
	public function __construct(
		protected PostCategory $postCategory
	) {}
	
    public function compose(View $view) {
       	$view->with([
			'styles' => $this->postCategory->getPostCategoriesCss()
		]);
    }
}
