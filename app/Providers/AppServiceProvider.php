<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\PageType;
use Auth;

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
        view()->composer('admin.layouts.sidebar', function ($view) {
            $user= Auth::user();
            if($user){
                $page= PageType::where('created_by',$user->id)->where('status','!=',0)->get();
                $view->with(['pageTypes'=>$page]);
            }else{
                $page= [];
                $view->with(['pageTypes'=>$page]);
            }
        });
    }
}
