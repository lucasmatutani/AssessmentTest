<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Books\BookRepositoryInterface;
use App\Infrastructure\Books\BookRepository;
use App\Infrastructure\Stores\StoreRepository;
use App\Domain\Stores\StoreRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(StoreRepositoryInterface::class, StoreRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
