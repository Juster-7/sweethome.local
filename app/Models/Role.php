<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
	use Sluggable;
	
	protected $fillable = ['name'];
	
	public function sluggable():array {
		return [ 'slug' => [ 
			'source' => 'name'
			]
		];
	}

	public function users() {
		return $this->hasMany(User::class);
	}
}