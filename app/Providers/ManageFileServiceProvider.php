<?php

namespace Desafio\Providers;

use Illuminate\Support\ServiceProvider;

class ManageFileServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind('Desafio\Contracts\ManageFile','Desafio\Storage\ManageFile');
    }
}