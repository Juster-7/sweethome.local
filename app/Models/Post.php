<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Post extends Model
{
    use HasFactory;
	use SoftDeletes;
	use Sluggable;
	
	protected $fillable = ['post_id', 'name', 'email', 'text', 'parent_id'];
	
	protected $casts = [ 'date_show' => 'date' ];
	
	public function sluggable():array {
		return [ 'slug' => [ 'source' => 'title' ]];
	}
	
	public function comments() {
		return $this->hasMany(Comment::class);
	}
	
	public function scopeActive($q) {
		return $q->where('date_show', '<', Carbon::now());
	}
	
	public function getLastPosts(int $count) {
		return $this->active()->latest('date_show')->take($count)->get();
	}
	
	public function getTopPosts(int $count) {
		return $this->active()->latest('hits')->take($count)->get();
	}
	
	public function getPost(int $id) {
		return $this->findOrFail($id);
	}
	
	
}
