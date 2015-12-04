<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helper\Image;

class ImagesServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Image', function() { return new Image; });
    }

    public function provides()
    {
        return ['image'];
    }
}
