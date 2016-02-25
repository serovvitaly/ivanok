<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        /**
         * Регистрация посещений
         */
        $user_id = null;
        if ($auth_user = \Auth::user()) {
            $user_id = $auth_user->id;
        }
        
        \DB::table('visits')->insert([
            'user_key' => \App\Helpers\AuthHelper::getUserKey(),
            'request_url' => \Request::fullUrl(),
            'remote_addr' => \Request::server('REMOTE_ADDR'),
            'user_id' => $user_id,
        ]);

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
