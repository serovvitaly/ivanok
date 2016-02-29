<?php
/**
 * Created by PhpStorm.
 * User: vitaly
 * Date: 29.02.16
 * Time: 17:57
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Memcached;

class MemcachedCache
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        /**
         * @var \Symfony\Component\HttpFoundation\Response $response
         */
        $response = $next($request);

        //Cache::store('memcached')->put($request->getRequestUri(), $response->getContent(), 1);

        $memcached = new Memcached;

        $memcached->addServer('127.0.0.1', '11211');

        $memcached->setOption(Memcached::OPT_COMPRESSION, false);

        $key = 'foo:' . $request->getRequestUri();
        
        $memcached->set($key, $response->getContent(), 1000);

        return $response;
    }
}