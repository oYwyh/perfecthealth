<?php

namespace App\Http\Middleware;

use Closure;

class PreventSearchIndexing
{
    public function handle($request, Closure $next)
    {
        if ($request->headers->get('referer') && preg_match('/(google|bing|yahoo)/i', $request->headers->get('referer'))) {
            return redirect('/home');
        }

        return $next($request);
    }
}
