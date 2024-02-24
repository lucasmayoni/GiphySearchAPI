<?php

namespace App\Providers;

use App\Repositories\AuditLogRepository;
use App\Repositories\AuditLogRepositoryInterface;
use App\Repositories\UserFavoriteRepository;
use App\Repositories\UserFavoriteRepositoryInterface;
use App\Services\SearchApiService;
use App\Services\SearchServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(SearchServiceInterface::class, function ($app) {
            $baseUrl = config('app.base_url');
            $apiKey = config('app.api_key');
            return new SearchApiService($baseUrl, $apiKey);
        });
        $this->app->bind(AuditLogRepositoryInterface::class, AuditLogRepository::class);
        $this->app->bind(UserFavoriteRepositoryInterface::class, UserFavoriteRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
