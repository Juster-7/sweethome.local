<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\LogRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\PostCategoryRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\ProductBrandRepositoryInterface;
use App\Interfaces\ProductCategoryRepositoryInterface;
use App\Repositories\LogRepository;
use App\Repositories\PostRepository;
use App\Repositories\PostCategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductBrandRepository;
use App\Repositories\ProductCategoryRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(LogRepositoryInterface::class, LogRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(PostCategoryRepositoryInterface::class, PostCategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductBrandRepositoryInterface::class, ProductBrandRepository::class);
        $this->app->bind(ProductCategoryRepositoryInterface::class, ProductCategoryRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
