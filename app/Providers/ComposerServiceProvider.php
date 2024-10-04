<?php

namespace App\Providers;

use App\Models\PostCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
	private $postCategory;
	
	public function __construct() {
		$this->postCategory = new PostCategory;
	}
	
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.menu', function($view) {
			$view->with(['menu' => $this->postCategory->getTopCategories(4)]);
		});
    }
}
