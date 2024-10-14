<?php

namespace App\View\Composers;

use App\Models\Post;
use Illuminate\View\View;

class IndexComposer
{
	public function __construct(
		protected Post $post
	) {}
	
    public function compose(View $view) {
       	$view->with(['top_posts' => $this->post->getTopPosts(4)]);
    }
}
