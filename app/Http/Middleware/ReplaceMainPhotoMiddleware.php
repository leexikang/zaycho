<?php

namespace App\Http\Middleware;

use Closure;
use App\Photo;
use App\Product;

class ReplaceMainPhotoMiddleware
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
