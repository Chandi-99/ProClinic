<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('within_30_days', function ($attribute, $value, $parameters, $validator) {
            $today = Carbon::today();
            $thirtyDaysFromNow = $today->copy()->addDays(30);
            $dateToValidate = Carbon::parse($value);
    
            return $dateToValidate->between($today, $thirtyDaysFromNow);
        });
    }
}
