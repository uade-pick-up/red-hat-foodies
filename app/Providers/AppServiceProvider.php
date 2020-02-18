<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use App\Setting;
use Session;

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
        try {
            \DB::connection()->getPdo();
            Schema::defaultStringLength(191);
            view()->composer('*',function($view){

                    if(\DB::connection()->getDatabaseName()){
                        if(Schema::hasTable('settings')){
                    $project_title = Setting::first()->project_title;
                    $cpy_txt = Setting::first()->cpy_txt;
                    $gsetting = Setting::first();

                    $view->with([
                        'project_title' => $project_title,
                        'cpy_txt'=> $cpy_txt,
                        'gsetting' => $gsetting
                    ]);
                    }
                }
            });
        }catch(\Exception $ex){

          return redirect('/get/step2');
        }
    
    }
}
