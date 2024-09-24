<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
	use SoftDeletes;
	use Sluggable;

	public function sluggable():array {
		return [ 'slug' => [ 'source' => 'title' ]];
	}
	
	public function products() {
		return $this->hasMany(Product::class);
	}
		
	public function getBrandBySlug($slug) {
		return $this->where('slug', $slug)->firstOrFail();
	}
	
	public function getTopBrands(int $count) {
		return $this
			->latest()
			->take($count)
			->get();
	}
}
