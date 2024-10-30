<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Post;
use App\Models\Product;

class MainLayout extends Component
{
    public function __construct() {
        //
    }

    public function render() {
		return view('layouts.main-layout');
    }
}
