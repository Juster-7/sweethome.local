<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
	use SoftDeletes;
	
	protected static function boot() {
		parent::boot();
		
		static::deleting(function ($instance) {
			$instance->children->each->delete();
		});
		static::restoring(function ($instance) {
			$instance->children->each->restore();
		});
	}
	
	public function post() {
		return $this->belongsTo(Post::class);
	}
	
	public function children() {
		return $this->hasMany(Comment::class, 'parent_id', 'id');
	}
	
	public function parent() {
		return $this->belongsTo(Comment::class, 'parent_id', 'id');
	}

	public function getCommentsByPost(Post $post) {
		return $this->where('post_id', $post->id)
			->where('parent_id', null)
			->latest('created_at')->get();
	}
	
	public function getCommentsCountByPost(Post $post) {
		return $this->where('post_id', $post->id)->count();
	}
	
	public function getPostByComment() {
		return $this->post;
	}
}
