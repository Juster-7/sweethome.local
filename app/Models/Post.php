<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Post extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
	
	protected $casts = [ 'date_show' => 'date' ];
	
	public function sluggable():array {
		return [ 'slug' => [ 'source' => 'title' ]];
	}
	
	public function postCategory() {
		return $this->belongsTo(PostCategory::class);
	}
	
	public function user() {
		return $this->belongsTo(User::class);
	}
	
	public function comments() {
		return $this->hasMany(Comment::class);
	}
	
	public function scopeActive($q) {
		return $q->where('date_show', '<', Carbon::now());
	}
	
	public function getPost(int $id) {
		return $this->findOrFail($id);
	}

	public function getPosts() {
		return $this->active()
			->with(['postCategory'])
			->latest('date_show')
			->paginate(config('posts_on_page'))
			->withQueryString();
	}
	
	public function getLastPosts(int $count) {
		return $this->active()
			->with(['postCategory'])
			->latest('date_show')
			->take($count)
			->get();
	}
	
	public function getTopPosts(int $count) {
		return $this
			->active()
			->with(['postCategory'])
			->latest('hits')
			->take($count)
			->get();
	}
		
	public function incrementHits(): void{
		$this->increment('hits');
	}
}
