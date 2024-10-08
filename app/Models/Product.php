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
	
	public function productCategory() {
		return $this->belongsTo(ProductCategory::class);
	}
	
	public function brand() {
		return $this->belongsTo(Brand::class);
	}
	
	public function carts() {
		return $this->belongsToMany(Cart::class)->withPivot('quantity');
	}
	
	public function getLastProducts(int $count) {
		return $this->latest('id')
			->with(['productCategory'])
			->take($count)
			->get();
	}
}
