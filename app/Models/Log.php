<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
	protected $fillable = ['created_at', 'user_id', 'duration', 'ip', 'url', 'method', 'input', 'agent'];
	
	public $timestamps = false;
	
	public function saveLog($request) {
		$this->user_id = auth()->id();
		$this->ip = $request->ip();
		$this->url = $request->fullUrl();
		$this->method = $request->method();
		$this->input = $request->getContent();
		$this->agent = $request->header('user-agent');
		$this->save();
	}
}
