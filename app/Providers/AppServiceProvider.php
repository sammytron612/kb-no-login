<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use App\Models\Setting;

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

        Gate::define('isAdmin', function(User $user) {
            return $user->role === 1;
            });

        Gate::define('isEditor', function(User $user) {
            return $user->role === 2;
            });

        Gate::define('isViewer', function(User $user) {
            return $user->role === 3;
            });

        Gate::define('canCreate', function(User $user) {
            return ($user->role === 1 || $user->role === 2);
            });

        Gate::define('canEdit', function(User $user, Article $article) {
            return ($user->role === 1 || $user->id === $article->author);
            });

        Gate::define('canDelete', function(User $user, Article $article) {
            // Admin can always delete

            if ($user->role === 1) {
                return true;
            }

            // Check if user is the author and if editors can delete setting is enabled
            if ($user->id === $article->author) {

                $setting = Setting::first();

                return $setting->editors === 1;
            }

            return false;
        });
    }
}
