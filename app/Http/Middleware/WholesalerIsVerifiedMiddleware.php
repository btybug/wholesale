<?php

namespace App\Http\Middleware;

use App\Models\LogActivities;
use Closure;
use Illuminate\Http\Request;

class WholesalerIsVerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->user() || ! $request->user()->wholesaler_status) {
            return $request->expectsJson()
                ? abort(403, 'Please hold on our Admins checking your details.')
                : \Redirect::route('verification_wholesaler');
        }

        return $next($request);
    }
}
