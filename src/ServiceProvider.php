<?php

namespace Ashishov\EloquentCounter;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
//        dd('testing');
//        dd(__DIR__.'/migrations');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
