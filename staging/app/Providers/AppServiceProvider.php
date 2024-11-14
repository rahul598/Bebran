<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Settings;

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
        Schema::defaultStringLength(191);
        $settings = Settings::get();
        foreach($settings as $setting)
        {
            config([$setting->key => $setting->value]);
        }
        $currency_with_icon_array = unserialize(Currency_With_Icon_Array);
        config(['currency' => $currency_with_icon_array[$_SESSION['currency']]]);
    }
}
