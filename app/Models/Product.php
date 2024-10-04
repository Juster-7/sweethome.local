<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory;
	use Sluggable;
	
	public function sluggable():array {
		return [ 'slug' => [ 'source' => 'title' ]];
	}
	
	public function category() {
		return $this->belongsTo(Category::class);
	}
	
	public function brand() {
		return $this->belongsTo(Brand::class);
	}
	
	public function carts() {
		return $this->belongsToMany(Cart::class)->withPivot('quantity');
	}
	
	public function getLastProducts(int $count) {
		return $this->latest('id')
			->with(['category'])
			->take($count)
			->get();
	}
}
