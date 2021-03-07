<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdrimarnServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helpers/User.php';
        require_once app_path() . '/Helpers/Validation.php';
        require_once app_path() . '/Helpers/Hash.php';
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
