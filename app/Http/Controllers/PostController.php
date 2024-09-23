<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Comment;

class PostController extends Controller
{
	private $post;
	private $comment;
	
	public function __construct() {
		$this->post = new Post;
		$this->comment = new Comment;
	}
	
	public function posts(Request $request) {
		$posts = $this->post
			->active()
			->latest('date_show')
			->when($request->filled('category'), function ($q) use ($request){
				$q->whereTheme($request->category);
			})
			->paginate(config('posts_on_page'))
			->withQueryString();
		$top_categories = $this->post->getTopCategories(3);		
		$all_categories = $this->post->getCategories(10); 
				
		return view('posts', compact('posts', 'top_categories', 'all_categories'));
	}
	
    public function post(string $slug, Request $request){		
		$post = $this->post->getPostBySlug($slug);
		$post->increment('hits');
		
		$comments = $this->comment->getCommentsByPost($post);
		$comments_count = $this->comment->getCommentsCountByPost($post);
		
		$top_posts = $this->post->getTopPosts(3);
		$top_categories = $this->post->getTopCategories(3);
		$all_categories = $this->post->getCategories(10);
		
		return view('post', compact('post', 'comments', 'comments_count', 'top_posts', 'top_categories', 'all_categories'));
	}	
}
