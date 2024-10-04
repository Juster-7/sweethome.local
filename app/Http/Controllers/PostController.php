<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Comment;

class PostController extends Controller
{
	private $postCategory;
	private $post;
	private $comment;
	
	public function __construct() {
		$this->postCategory = new PostCategory;
		$this->post = new Post;
		$this->comment = new Comment;
	}
	
	public function index() {
		$posts = $this->post->getPosts();
		$top_categories = $this->postCategory->getTopCategories(3);		
		$all_categories = $this->postCategory->getCategories(10); 
				
		return view('posts', compact('posts', 'top_categories', 'all_categories'));
	}
	
	public function postCategory(PostCategory $postCategory){		
		$posts = $postCategory->posts()->with(['postCategory'])->paginate(config('posts_on_page'))->withQueryString();
		$top_categories = $this->postCategory->getTopCategories(3);		
		$all_categories = $this->postCategory->getCategories(10); 
				
		return view('posts', compact('posts', 'postCategory', 'top_categories', 'all_categories'));
	}
	
    public function post(Post $post, Request $request){		
		$post->incrementHits();
		
		//$comments = $this->comment->getCommentsByPost($post);
		//$comments_count = $this->comment->getCommentsCountByPost($post);
		$comments = $post->comments()->with(['children'])->whereNull('parent_id')->get();
		$comments_count = $post->comments->count();
		
		$top_posts = $this->post->getTopPosts(3);
		$top_categories = $this->postCategory->getTopCategories(3);
		$all_categories = $this->postCategory->getCategories(10);
		
		return view('post', compact('post', 'comments', 'comments_count', 'top_posts', 'top_categories', 'all_categories'));
	}	
}
