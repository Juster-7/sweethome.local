<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function contacts() {
		return view('contacts');
	}
	
	public function about() {
		return view('about');
	}
}
