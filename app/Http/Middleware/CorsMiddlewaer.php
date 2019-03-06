<?php namespace App\Http\Middleware;

use Closure;

class CorsMiddlewaer
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
        if ($request->getMethod() === "OPTIONS") {
            $response = \Response::make('');
            if (!empty($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], ['http://localhost:8090'])) {
                $response->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN']);
            } else {
                $response->header('Access-Control-Allow-Origin','*');
            }
            $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization');
            $response->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
            $response->header('Access-Control-Allow-Credentials', 'true');
            $response->header('X-Content-Type-Options', 'nosniff');
            return $response;
        }
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization')
            ->header('Access-Control-Allow-Methods','POST, GET, OPTIONS, PUT, DELETE')
            ->header('Access-Control-Allow-Credentials', 'true')
            ->header('X-Content-Type-Options', 'nosniff');
    }
}
