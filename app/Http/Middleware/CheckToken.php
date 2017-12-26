<?php
/**
 * Created by PhpStorm.
 * User: stoyan
 * Date: 12/25/17
 * Time: 11:41 PM
 */

namespace App\Http\Middleware;

use Closure;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
