<?php

namespace App\Providers;

use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\Contracts\LikeRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\LikeRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use App\Repositories\CommentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(LikeRepositoryInterface::class, LikeRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
