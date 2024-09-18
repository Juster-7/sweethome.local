<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Product;

class MainController extends Controller
{
    public function index() {
		$posts = Post::where('date_show', '<', Carbon::now())
			->orderByDesc('date_show')
			->take(7)
			->get();
		$top_posts = Post::where('date_show', '<', Carbon::now())
			->orderByDesc('hits')
			->take(3)
			->get();
		$products = Product::orderByDesc('id')->take(4)->get();
        
		return view('index', [
			'posts' => $posts,
			'top_posts' => $top_posts,
			'products' => $products
		]);
	}
	
	public function articles(Request $request) {
		$posts = new Post;
		if($request->category){
			$posts = $posts->where('theme', $request->category);
		}
		$posts = $posts->where('date_show', '<', Carbon::now())
			->orderByDesc('date_show')
			->paginate(env('CUSTOM_OPTION_POSTS_ON_PAGE'))
			->withQueryString();
		
		$top_categories = Post::where('date_show', '<', Carbon::now())
			->groupBy('theme')
			->selectRaw('theme, count(*) as total')
			->orderByDesc('total', 'theme')
			->take(3)
			->get();
		
		$all_categories = Post::where('date_show', '<', Carbon::now())
			->distinct()
			->take(10)
			->get('theme');
		
		
		return view('articles', [
			'posts' => $posts,
			'top_categories' => $top_categories,
			'all_categories' => $all_categories,
		]);
	}
	
	public function article(string $alias, Request $request){
		$this->setAccessToken($request);
		if ($request->add_comment) {
			$validator = Validator::make($request->all(), [
				'post_id' => 'required|numeric',
				'name' => 'required|alpha|max:100',
				'email' => 'required|email',
				'text' => 'required|max:250',
				'parent_id' => 'numeric|nullable',
			]);
			if($validator->fails()) return redirect()->route('article.add_comment', ['id' => $id])->withInput()->withErrors($validator->errors());
			$validated = $validator->validated();
			$comment = new Comment();
			$comment->post_id = $validated['post_id'];
			$comment->name = $validated['name'];
			$comment->email = $validated['email'];
			$comment->text = $validated['text'];
			$comment->parent_id = $validated['parent_id'];
			$comment->access_token = $request->session()->get('access_token');
			$comment->save();
			return redirect()->route('article.comments', ['alias' => $alias]);
		}
		
		$post = Post::where('alias', $alias)
			->first();
		if(!$post) abort(404);
		$comments = Comment::where('post_id', $post->id)
			->where('parent_id', null)
			->orderByDesc('created_at')->get();
		$comments_count = Comment::where('post_id', $post->id)
			->count();
		$top_posts = Post::where('date_show', '<', Carbon::now())
			->orderByDesc('hits')
			->take(3)
			->get();
		$top_categories = Post::where('date_show', '<', Carbon::now())
			->groupBy('theme')
			->selectRaw('theme, count(*) as total')
			->orderByDesc('total', 'theme')
			->take(3)
			->get();
		$all_categories = Post::where('date_show', '<', Carbon::now())
			->distinct()
			->take(10)
			->get('theme');
			
		return view('article', [
			'post' => $post,
			'comments' => $comments,
			'comments_count' => $comments_count,
			'top_posts' => $top_posts,
			'top_categories' => $top_categories,
			'all_categories' => $all_categories,
		]);
	}
	
	public function setAccessToken(Request $request) {
		if ($request->session()->missing('access_token')) {
			$request->session()->put('access_token', Str::random(32));
		}
	}
	
	public function contacts() {
		return view('contacts');
	}
	
	public function deleteComment(Comment $comment) {
		$post = $comment->post;
		$comment->delete();
		return redirect()->route('article.comments', ['alias' => $post->alias]);
	}
	
	public function search(Request $request) {
		if($request->search) {
			$validated = $request->validate([
				'search' => 'required|string|min:2|max:200'
			]);
			$search = $validated['search'];
			$posts = Post::where('title', 'LIKE', "%$search%")
				->orWhere('intro_text', 'LIKE', "%$search%")
				->orWhere('main_text', 'LIKE', "%$search%")
				->paginate(env('CUSTOM_OPTION_POSTS_ON_PAGE'))
				->withQueryString();
		}
		else return redirect()->route('index');
		return view('search', [
			'search' => $search,
			'posts' => $posts,
		]);
	}
}
