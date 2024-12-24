<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
	protected $fillable = ['created_at', 'user_id', 'duration', 'ip', 'url', 'method', 'input', 'agent'];
	public $timestamps = false;
}
