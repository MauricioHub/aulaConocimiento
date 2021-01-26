<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Menu;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {        
        $menul= Menu::whereNull('id_padre')
        ->get();
        $menu = DB::table('menu')->get();          
        View::share('menu', $menu);
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
