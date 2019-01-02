<?php

namespace App\Providers;

use App\Helpers\Contracts\PhotoFileContract;
use App\Helpers\PhotoFileNativePhp;
use Illuminate\Support\ServiceProvider;

class PhotoFileServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register a contract for saving photo files and their cutting.
        $this->app->bind(PhotoFileContract::class, function (){
           return new PhotoFileNativePhp();
        });
    }
}
