<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Interfaces\Backend\MainCategoryRepositoryInterface;
use App\Repositories\MainCategoryRepository;

use App\Repositories\Interfaces\Backend\SubCategoryRepositoryInterface;
use App\Repositories\SubCategoryRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Bind Main Category Repositories
        $this->app->bind(
            MainCategoryRepositoryInterface::class,
            MainCategoryRepository::class,
        );

        //Bind Sub Category Repositories
        $this->app->bind(
            SubCategoryRepositoryInterface::class,
            SubCategoryRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
