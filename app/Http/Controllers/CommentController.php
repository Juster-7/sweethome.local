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
	
	public function __construct(Post $post) {
		$this->post = $post;
	}
	
	public function redirectToPostAddComments($post) {
		return redirect()->route('posts.post.add_comment', $post->slug);
	}
	
	public function redirectToPostComments($post) {
		return redirect()->route('posts.post.comments', $post->slug);
	}
	
	public function delete(Comment $comment) {
		$post = $comment->post;
		$comment->deleteOrFail();
		return $this->redirectToPostComments($post);
	}
	
	//public function store(AddCommentRequest $request) {
	public function store(Request $request) {
		$post = $this->post->getPost($request->post_id);
	
		$validator = Validator::make($request->all(), [
			'post_id' => 'required|numeric',
			'user_id' => 'required|numeric',
			'text' => 'required|max:250',
			'parent_id' => 'numeric|nullable',
		]);
		if($validator->fails()) return $this->redirectToPostAddComments($post)->withInput()->withErrors($validator->errors());
		
		$validated = $validator->validated();		
		$comment = new Comment();
		$comment->post_id = $validated['post_id'];
		$comment->user_id = $validated['user_id'];
		$comment->text = $validated['text'];
		$comment->parent_id = $validated['parent_id'];
		$comment->save();
		
		return $this->redirectToPostComments($post);
	}
}