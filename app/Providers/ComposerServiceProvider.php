<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\ProductCategory;
use App\Models\Brand;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
	private $postCategory;	
	private $post;
	private $productCategory;
	private $brand;
	
	public function __construct() {
		$this->postCategory = new PostCategory;
		$this->post = new Post;
		$this->productCategory = new ProductCategory;
		$this->brand = new Brand;
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
        View::composer('*', function($view) {
			$view->with(['last_posts' => $this->post->getLastPosts(4)]);
		});		
		View::composer(['layouts.header-menu', 'layouts.footer-menu'], function($view) {
			$view->with(['menu' => $this->postCategory->getTopCategories(4)]);
		});
		View::composer(['index', 'posts', 'post'], function($view) {
			$view->with(['top_posts' => $this->post->getTopPosts(4)]);
		});
		View::composer(['posts', 'post'], function($view) {
			$view->with([
				'top_categories' => $this->postCategory->getTopCategories(5),
				'all_categories' => $this->postCategory->getCategories(10),
			]);			
		});
		View::composer(['shop.index', 'shop.product-category', 'shop.brand', 'shop.product'], function($view) {
			$view->with([
				'root_categories' => $this->productCategory->getRootCategories(),
				'top_brands' => $this->brand->getTopBrands(4),
			]);
		});
    }
}
