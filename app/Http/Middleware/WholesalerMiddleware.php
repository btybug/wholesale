<?php

namespace App\Http\Middleware;

use Closure;

class WholesalerMiddleware
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
            if (\Auth::check()) {
                $user=\Auth::user();
                if($user->isWholeseler()){
                    return $next($request);
                }
            }
            abort('404');
    }
}
