<?php

namespace Desafio\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $user = Auth::user();
            $user_img_path = !empty($user->image) ? 
                "storage/users/".$user->image :
                "img/user2-160x160.jpg";
             $view->with('user_img_path', $user_img_path);
        });     
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
