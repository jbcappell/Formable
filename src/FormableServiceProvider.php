<?php

namespace jbcappell\Formable;

use Illuminate\Support\ServiceProvider;

class FormableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->loadViewsFrom(__DIR__.'/resources/views', 'Formable');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
