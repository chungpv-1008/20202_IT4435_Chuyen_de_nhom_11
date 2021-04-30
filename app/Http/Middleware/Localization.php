<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App;

class Localization
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
        $language = Session::get('language', config('app.locale'));
        App::setLocale($language);

        return $next($request);
    }
}
