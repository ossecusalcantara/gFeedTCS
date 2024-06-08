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
        $this->app->bind(\App\Repositories\QuestionRepository::class, \App\Repositories\QuestionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PerformanceEvaluationRepository::class, \App\Repositories\PerformanceEvaluationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DevelopmentPlanRepository::class, \App\Repositories\DevelopmentPlanRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PermissionRepository::class, \App\Repositories\PermissionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AnswersEvaluationRepository::class, \App\Repositories\AnswersEvaluationRepositoryEloquent::class);
        //:end-bindings:
    }
}
