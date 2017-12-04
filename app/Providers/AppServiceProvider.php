<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\Horizon as Horizon;
use Illuminate\Support\Facades\Auth;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Only editor or higher can use Horizon
        Horizon::auth(function ($request) {
            $user = User::findOrFail(Auth::user()->id);
            if ($user->role > 5)
                return true;
            return false;
        });
    }
}
