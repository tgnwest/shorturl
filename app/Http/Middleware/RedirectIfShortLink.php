<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfShortLink
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
        if ($request->is(['/', 'urls', 'urls/*'])){
            return $next($request);
        } else {
            dd('sdfsdf');
        }
    }
}
