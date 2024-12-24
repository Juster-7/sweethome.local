<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use App\Traits\HasComments;

class Post extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
	use AsSource;
	use Filterable;
	use HasComments;
	
	protected $fillable = [
		'meta_description', 
		'meta_keyword', 
		'post_category_id', 
		'user_id', 
		'title', 
		'intro_text', 
		'main_text', 
		'date_show'
	];	
	
	protected $casts = [ 
		'date_show' => 'date' 
	];
	
	protected $allowedSorts = [
		'id',
		'title',
		'hits',
		'created_at',
	];
	
	public function sluggable():array {
		return [ 'slug' => [ 
			'source' => 'title',
			'onUpdate' => true
			]
		];
	}
	
	public function postCategory() {
		return $this->belongsTo(PostCategory::class);
	}
	
	public function user() {
		return $this->belongsTo(User::class);
	}
	
	public function scopeActive($query): void {
		$query->where('date_show', '<', now());
	}
}
