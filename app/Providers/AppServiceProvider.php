<?php

namespace App\Providers;


use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
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
         if (!Collection::hasMacro('simplePaginate')) {

    Collection::macro('simplePaginate', 
        function ($perPage = 15, $page = null, $options = []) {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        return (
            new Paginator(
                $this->forPage($page, $perPage), 
                $perPage, 
                $page, 
                $options
            )
        )->withPath('');
    });
}
    }
}
