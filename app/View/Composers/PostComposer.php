<?php

namespace App\View\Composers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\View\View;

class PostComposer
{
	public function __construct(
		protected Post $post,
		protected PostCategory $postCategory
	) {}
	
    public function compose(View $view) {
       	$view->with([
				'top_posts' => $this->post->getTopPosts(4),
				'top_categories' => $this->postCategory->getTopCategories(5),
				'all_categories' => $this->postCategory->getCategories(10),
			]);
    }
}
