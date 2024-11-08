<?php

namespace App\Providers;

use App\View\Composers\IndexComposer;
use App\View\Composers\HeaderComposer;
use App\View\Composers\StylesComposer;
use App\View\Composers\MenuComposer;
use App\View\Composers\PostComposer;
use App\View\Composers\ShopComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
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
		View::composer('layouts.header', HeaderComposer::class);
		View::composer('layouts.styles', StylesComposer::class);
		View::composer(['layouts.header-menu', 'layouts.footer-menu'], MenuComposer::class);
		View::composer(['posts', 'post'], PostComposer::class);
		View::composer(['shop.index', 'shop.product-category', 'shop.brand', 'shop.product'], ShopComposer::class);
    }
}
