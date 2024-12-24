<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Traits\HasComments;

class Product extends Model
{
    use HasFactory;
	use Sluggable;
	use HasComments;

	protected $fillable = ['product_category_id', 'brand_id', 'title', 'slug', 'intro_text', 'main_text', 'image', 'price', 'quantity'];

	public function sluggable():array {
		return [ 'slug' => [
			'source' => 'title',
			'onUpdate' => true
			]
		];
	}

	public function productCategory() {
		return $this->belongsTo(ProductCategory::class);
	}

	public function productBrand() {
		return $this->belongsTo(ProductBrand::class);
	}

	public function carts() {
		return $this->belongsToMany(Cart::class)->withPivot('quantity');
	}
}
