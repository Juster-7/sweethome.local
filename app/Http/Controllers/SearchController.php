<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;

class SearchController extends Controller
{
    public function search(Request $request) {
		if($request->search) {
			$validated = $request->validate([
				'search' => 'bail|required|string|min:2|max:200'
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
