<?php

namespace App\Providers;

use App\Repositories\StmtRepository;
use App\Repositories\StmtRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Регистрация сервисов.
     *
     */
    public function register(): void
    {
        $this->app->bind(StmtRepositoryInterface::class, StmtRepository::class);
    }
}
