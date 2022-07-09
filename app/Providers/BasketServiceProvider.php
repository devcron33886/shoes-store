<?php

namespace App\Providers;

use App\Basket\Basket;
use App\Basket\Contracts\BasketInterface;
use Illuminate\Support\ServiceProvider;

class BasketServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(BasketInterface::class,function (){
            return new Basket(session());
        });
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
