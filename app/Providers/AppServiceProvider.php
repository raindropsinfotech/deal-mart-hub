<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Interfaces\Backend\MainCategoryRepositoryInterface;
use App\Repositories\MainCategoryRepository;

use App\Repositories\Interfaces\Backend\SubCategoryRepositoryInterface;
use App\Repositories\SubCategoryRepository;

use App\Repositories\Interfaces\Backend\UserRepositoryInterface;
use App\Repositories\UserRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Bind User Repository
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class,
        );

        //Bind Main Category Repository
        $this->app->bind(
            MainCategoryRepositoryInterface::class,
            MainCategoryRepository::class,
        );

        //Bind Sub Category Repository
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
