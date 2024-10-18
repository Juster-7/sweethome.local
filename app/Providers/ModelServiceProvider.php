<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
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
        Model::preventLazyLoading(!$this->app->isProduction());
		Model::preventAccessingMissingAttributes();
		Model::preventSilentlyDiscardingAttributes();
    
		// Включает все 3 параметра одной командой
		//Model::shouldBeStrict();
	}
}
