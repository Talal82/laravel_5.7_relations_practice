<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Add this custom validation rule.
        Validator::extend('alpha_spaces', function ($attribute, $value) {

        // This will only accept alpha and spaces. 
        // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[\pL\s]+$/u', $value); 

        });

        Relation::morphMap([
            'main_cat' => 'App\Category',
            'sub_cat' => 'App\SubCategory',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
