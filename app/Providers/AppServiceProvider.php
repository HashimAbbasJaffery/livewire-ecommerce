<?php

namespace App\Providers;

use App\Models\Setting;
use App\Policies\CoursePolicy;
use Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Course;
use View;

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
        Paginator::defaultView("vendor.pagination.default");

        Gate::define("admin", function() {
            return auth()->user()->is_admin;
        });

        View::composer("*", function($view) {
            $setting = Setting::where("active", true)->first();
            session()->put("shipping", $setting->shipping_charges);
            $view->with("setting", $setting);
        });

    }
}
