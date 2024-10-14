<?php

namespace App\View\Composers;

use App\Models\PostCategory;
use Illuminate\View\View;

class MenuComposer
{
	private $postCategory;
	
	public function __construct(PostCategory $postCategory) {
		$this->postCategory = $postCategory;
	}
	
    public function compose(View $view) {
       	$view->with(['menu' => $this->postCategory->getTopCategories(3)]);
    }
}
