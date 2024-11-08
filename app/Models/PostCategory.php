<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class PostCategory extends Model
{
    use HasFactory;
	use SoftDeletes;
	use Sluggable;
	use AsSource;
	use Filterable;
	
	protected $fillable = ['title', 'css_color'];	

	public function sluggable():array {
		return [ 'slug' => [ 
			'source' => 'title',
			'onUpdate' => true
			]
		];
	}
	
	public function posts() {
		return $this->hasMany(Post::class);
	}
	
	public function getTopCategories(int $count) {
		return $this
			->withCount('posts')
			->orderByDesc('posts_count')
			->take($count)
			->get();	
	}
	
	public function getRandomCategories(int $count) {
		return $this->select('title', 'slug')
			->distinct()
			->inRandomOrder()
			->take($count)
			->get();
	}
	
	public function getPostCategoriesCss() {
		return $this->select('id', 'css_color')
			->get();
	}
}
