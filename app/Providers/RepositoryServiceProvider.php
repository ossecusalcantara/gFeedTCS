<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DepartamentRepository::class, \App\Repositories\DepartamentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OfficeRepository::class, \App\Repositories\OfficeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProfileRepository::class, \App\Repositories\ProfileRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CharacteristicsRepository::class, \App\Repositories\CharacteristicsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SkillRepository::class, \App\Repositories\SkillRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SkillProfileRepository::class, \App\Repositories\SkillProfileRepositoryEloquent::class);
        //:end-bindings:
    }
}
