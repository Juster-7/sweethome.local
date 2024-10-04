<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
//use App\Http\Requests\AddCommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
	private $post;
	
	public function __construct() {
		$this->post = new Post;
	}
	
	public function redirectToPostAddComments(Post $post) {
		return redirect()->route('posts.post.add_comment', [ $post->slug]);
	}
	
	public function redirectToPostComments(Post $post) {
		return redirect()->route('posts.post.comments', [ $post->slug]);
	}
	
	public function delete(Comment $comment) {
		$post = $comment->getPostByComment();
		$comment->deleteOrFail();
		return $this->redirectToPostComments($post);
	}
	
	//public function store(AddCommentRequest $request) {
	public function store(Request $request) {
		$this->setAccessToken($request);
		$post = $this->post->getPost($request->post_id);
	
		$validator = Validator::make($request->all(), [
			'post_id' => 'required|numeric',
			'name' => 'required|alpha|max:100',
			'email' => 'required|email',
			'text' => 'required|max:250',
			'parent_id' => 'numeric|nullable',
		]);
		if($validator->fails()) return $this->redirectToPostAddComments($post)->withInput()->withErrors($validator->errors());
		
		$validated = $validator->validated();		
		$comment = new Comment();
		$comment->post_id = $validated['post_id'];
		$comment->name = $validated['name'];
		$comment->email = $validated['email'];
		$comment->text = $validated['text'];
		$comment->parent_id = $validated['parent_id'];
		$comment->access_token = $request->session()->get('access_token');
		$comment->save();
		
		return $this->redirectToPostComments($post);
	}
	
	public function setAccessToken(Request $request) {
		if ($request->session()->missing('access_token')) {
			$request->session()->put('access_token', Str::random(32));
		}
	}
}