<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SearchRequest;
use App\Models\Post;

class SearchController extends Controller
{
	public function __construct(
		protected Post $post
	) {}
	
    public function search(searchRequest $request) {
		$search = $request->validated()['search'];
		$posts = $this->post
				->where('title', 'LIKE', "%$search%")
				->orWhere('intro_text', 'LIKE', "%$search%")
				->orWhere('main_text', 'LIKE', "%$search%")
				->with(['postCategory'])
				->paginate(env('CUSTOM_OPTION_POSTS_ON_PAGE'))
				->withQueryString();
		
		return view('search', compact('posts'));
	}
}
