<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
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
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('analytics', function ($user) {

            if ( ! $user->isSuperAdmin() ) {
                return true;
            }
            
            return false;
        });

        $gate->before(function ($user, $ability) {
            /*if ($user->isSuperAdmin()) {
                return true;
            }*/
        });

        $gate->define('developer', function ($user) {
            return $user->isSuperAdmin();
        });

        $gate->define('view-posts-list', function ($user) {
            return (bool) $user;
        });

        $gate->define('create-post', function ($user) {
            return true;
        });

        $gate->define('update-post', function ($user, $post) {

            if ($user->isSuperAdmin()) {

                return true;
            }

            return $user->id == $post->user_id;
        });

        $gate->define('publication-post', function ($user, $post) {

            if ($user->isSuperAdmin()) {

                return true;
            }
        });


    }
}
