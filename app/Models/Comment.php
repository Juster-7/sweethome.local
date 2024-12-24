<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $fillable = ['commentable_id', 'commentable_type', 'user_id', 'text', 'parent_id'];

	protected static function boot() {
		parent::boot();

		static::deleting(function ($instance) {
			$instance->load('children')->children->each->delete();
		});
		static::restoring(function ($instance) {
			$instance->load('children')->children->each->restore();
		});
	}

	public function commentable() {
		return $this->morphTo();
	}

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function children() {
		return $this->hasMany(Comment::class, 'parent_id', 'id');
	}

	public function parent() {
		return $this->belongsTo(Comment::class, 'parent_id', 'id');
	}
}
