<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
	public function getPosts() {
		return Post::active()
			->with(['postCategory'])
			->latest('date_show')
			->paginate(config('posts_on_page'))
			->withQueryString();
	}

	public function getLastPosts(int $count) {
		return Post::active()
			->with(['postCategory'])
			->latest('date_show')
			->take($count)
			->get();
	}

	public function getTopPosts(int $count) {
		return Post::active()
			->with(['postCategory'])
			->latest('hits')
			->take($count)
			->get();
	}
}
