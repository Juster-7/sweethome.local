<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

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

	public function users(): Relation {
		return $this->hasMany(User::class);
	}
}
