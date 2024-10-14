<?php

namespace App\View\Composers;

use App\Models\Post;
use Illuminate\View\View;

class IndexComposer
{
	private $post;
	
	public function __construct(Post $post) {
		$this->post = $post;
	}
	
    public function compose(View $view) {
       	$view->with(['top_posts' => $this->post->getTopPosts(4)]);
    }
}
