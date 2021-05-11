<?php

namespace App\Providers;

use App\Models\Menu;
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
        \View::composer('layouts.menu', function ($view) {
            $view->with(['menus' => Menu::where('parent_id',0)->with('childs')->orderBy('sort','asc')->get()]);
        });
    }
}
