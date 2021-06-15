<?php

namespace App\Providers;

use App\Repositories\CountryJsonRepository;
use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Repositories\CustomerEloquentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CustomerRepositoryInterface::class, CustomerEloquentRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryJsonRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
