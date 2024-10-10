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
				
		return view('posts', compact('posts'));
	}
	
	public function postCategory(PostCategory $postCategory){		
		$posts = $postCategory->posts()->with(['postCategory'])->paginate(config('posts_on_page'))->withQueryString();
				
		return view('posts', compact('posts', 'postCategory'));
	}
	
    public function post(Post $post){		
		$post->incrementHits();		
		$comments = $post->comments()->with(['children', 'user'])->whereNull('parent_id')->get();
		$comments_count = $post->comments->count();
		
		return view('post', compact('post', 'comments', 'comments_count'));
	}	
}
