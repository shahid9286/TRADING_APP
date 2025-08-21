<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use App\Models\BusinessRule;


class AppServiceProvider extends ServiceProvider
{
    /* Register any application services */
    public function register(): void
    {
        // You can bind services or repositories here if needed
    }
    /* Bootstrap any application services */
    public function boot(): void
    {
        // Only share 'setting' view data if the table exists
        
        if (Schema::hasTable('settings')) {
            $setting = Setting::first();
            View::share('setting', $setting);
        }

        if (Schema::hasTable('business_rules')) {
            $bussiness_rule = BusinessRule::first();
            View::share('bussiness_rule', $bussiness_rule);
        }

    }

}
