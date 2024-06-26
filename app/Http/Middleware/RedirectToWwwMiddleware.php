<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;

class RedirectToWwwMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (strpos($request->header('host'), 'localhost') === false && substr($request->header('host'), 0, 4) != 'www.') {
            $request->headers->set('host', 'www.tagproperties.com');

            return Redirect::to($request->path());
        }
        
        return $next($request);
    }
}
