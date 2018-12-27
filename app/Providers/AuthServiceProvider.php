<?php

namespace App\Providers;

use App\Photo;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Create authorization rules for image editing.
        Gate::define('author-policy', function (User $user, Photo $photo) {
            if ($user->id === $photo->user_id) {
                return true;
            }
            return false;
        });
    }
}
