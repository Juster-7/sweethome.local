<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Requests\AddCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
	public function __construct(
		protected Comment $comment
	) {}
	
	public function delete(Comment $comment) {
		$comment->deleteOrFail();
		
		return back()->withFragment('#comments');
	}
	
	public function store(AddCommentRequest $request) {
		$this->comment->fill($request->validated())->save();
		
		return back()->withFragment('#comments');
	}
}