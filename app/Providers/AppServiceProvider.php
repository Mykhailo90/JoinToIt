<?php

namespace App\Providers;

use App\Company;
use App\Employee;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('*', function($view) {
            $companiesCount = Company::all()->count();
            $employeesCount = Employee::all()->count();

            $view->with([
                "companiesCount" => $companiesCount,
                "employeesCount" => $employeesCount
            ]);
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
