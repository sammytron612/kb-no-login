<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Models\Article;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Gate::define('isAdmin', function($user) {
            return $user->admin === 1;
            });

        Gate::define('canEditOrDelete', function($user, $article) {
            return ($user->admin === 1 || $user->id === $article->author);
            });
    }
}
