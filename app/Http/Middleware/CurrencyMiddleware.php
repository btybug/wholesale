<?php namespace App\Http\Middleware;

use App\Models\Currencies;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class CurrencyMiddleware
{
    public function handle($request, Closure $next)
    {
        $default = site_default_currency();

        $currency = (\Cookie::get('currency')) ? \Cookie::get('currency')
            : (($default) ? $default->code : null);

        \View::share('currency', $currency);

        return $next($request);
    }
}