<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Register Sqlite REGEXP Function
        DB::connection()->getPDO()->sqliteCreateFunction('regexp',
            function ($pattern, $data, $delimiter = '~', $modifiers = 'isuS')
            {
                if (isset($pattern, $data) === true)
                {
                    return (preg_match(sprintf('%1$s%2$s%1$s%3$s', $delimiter, $pattern, $modifiers), $data) > 0);
                }
                return null;
            }
        );
    }
}
