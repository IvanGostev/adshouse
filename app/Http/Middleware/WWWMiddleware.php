<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class WWWMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (substr($request->header('host'), 0, 4) === 'www.') {
            $request->headers->set('host', 'ads.adshouse.ae');
            return Redirect::to($request->path());
        }
        return $next($request);
    }
}
