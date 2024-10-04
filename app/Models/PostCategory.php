<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use HasFactory;
	use SoftDeletes;
	use Sluggable;

	public function sluggable():array {
		return [ 'slug' => [ 'source' => 'title' ]];
	}
	
	public function posts() {
		return $this->hasMany(Post::class);
	}
	
	public function getTopCategories(int $count) {
		return $this->withCount('posts')
			->orderByDesc('posts_count')
			->take($count)
			->get();	
	}
	
	public function getCategories(int $count) {
		return $this->distinct()
			->inRandomOrder()
			->take($count)
			->get();
	}
}
