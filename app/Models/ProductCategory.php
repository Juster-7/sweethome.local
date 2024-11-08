<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory;
	use SoftDeletes;
	use Sluggable;

	public function sluggable():array {
		return [ 'slug' => [ 
			'source' => 'title',
			'onUpdate' => true
			]
		];
	}
	
	public function children() {
		return $this->hasMany(ProductCategory::class, 'parent_id', 'id');
	}
	
	public function parent() {
		return $this->belongsTo(ProductCategory::class, 'parent_id', 'id');
	}
	
	public function products() {
		return $this->hasMany(Product::class);
	}
	
	public function getRootCategories() {
		return $this->where('parent_id', 0)->get();
	}
}
