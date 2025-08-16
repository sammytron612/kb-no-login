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
            return $user->role === 1;
            });
        Gate::define('isEditor', function($user) {
            return $user->role === 2;
            });
        Gate::define('isViewer', function($user) {
            return $user->role === 3;
            });
        Gate::define('canCreate', function($user) {
            return ($user->role === 1 || $user->role === 2);
            });
        Gate::define('canEditOrDelete', function($user, $article) {
            return ($user->role === 1 || $user->id === $article->author);
            });
    }
}
