<?php

namespace App\View\Composers;

use App\Models\PostCategory;
use Illuminate\View\View;

class MenuComposer
{
	public function __construct(
		protected PostCategory $postCategory
	) {}
	
    public function compose(View $view) {
       	$view->with(['menu' => $this->postCategory->getTopCategories(3)]);
    }
}
