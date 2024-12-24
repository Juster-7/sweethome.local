<?php

namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\View\View;

class PostController extends Controller
{
	public function __construct(
		protected PostRepositoryInterface $postRepository
	) {}

	public function index(Post $post): view {
		$posts = $this->postRepository->getPosts();

		return view('posts', compact('posts'));
	}

	public function postCategory(PostCategory $postCategory): view {
		$posts = $postCategory->posts()->with(['postCategory'])->paginate(config('posts_on_page'))->withQueryString();

		return view('posts', compact('posts', 'postCategory'));
	}

    public function post(Post $post): view {
		$post->increment('hits');
		$post->loadCount(['comments']);
		$comments = $post->comments()->with(['children', 'user'])->whereNull('parent_id')->get();

		return view('post', compact('post', 'comments'));
	}
}
