<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Post;
use App\Models\Product;

class MainLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
		//$posts = Post::orderByDesc('id')->get();
		//$products = Product::orderByDesc('id')->get();
        return view('layouts.main-layout');
    }
}
