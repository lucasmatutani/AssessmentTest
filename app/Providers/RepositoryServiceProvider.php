<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Books\BookRepositoryInterface;
use App\Infrastructure\Books\BookRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
