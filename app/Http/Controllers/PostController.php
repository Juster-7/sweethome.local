<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Comment;

class PostController extends Controller
{
	public function posts(Request $request) {
		$posts = new Post;
		if($request->category){
			$posts = $posts->where('theme', $request->category);			
		}
		$posts = $posts->active()
			->orderByDesc('date_show')
			->paginate(env('CUSTOM_OPTION_POSTS_ON_PAGE'))
			->withQueryString();
		
		$top_categories = Post::active()
			->groupBy('theme')
			->selectRaw('theme, count(*) as total')
			->orderByDesc('total', 'theme')
			->take(3)
			->get();
		
		$all_categories = Post::active()
			->distinct()
			->take(10)
			->get('theme');
		
		
		return view('posts', [
			'posts' => $posts,
			'top_categories' => $top_categories,
			'all_categories' => $all_categories,
		]);
	}
	
    public function post(string $slug, Request $request){
		
		
		$post = Post::where('slug', $slug)->firstOrFail();
		$comments = Comment::where('post_id', $post->id)
			->where('parent_id', null)
			->orderByDesc('created_at')->get();
		$comments_count = Comment::where('post_id', $post->id)
			->count();
		$top_posts = Post::active()
			->orderByDesc('hits')
			->take(3)
			->get();
		$top_categories = Post::active()
			->groupBy('theme')
			->selectRaw('theme, count(*) as total')
			->orderByDesc('total', 'theme')
			->take(3)
			->get();
		$all_categories = Post::active()
			->distinct()
			->take(10)
			->get('theme');
			
		return view('post', [
			'post' => $post,
			'comments' => $comments,
			'comments_count' => $comments_count,
			'top_posts' => $top_posts,
			'top_categories' => $top_categories,
			'all_categories' => $all_categories,
		]);
	}
	
	
	
}
