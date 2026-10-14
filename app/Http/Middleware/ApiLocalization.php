<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiLocalization
{
    public function handle(Request $request, Closure $next): Response
{
    $supportedLocales = ['ar', 'en'];

    $locale = $request->hasHeader('Accept-Language')
        ? $request->getPreferredLanguage($supportedLocales)
        : config('app.locale');

    if (!in_array($locale, $supportedLocales, true)) {
        $locale = config('app.locale');
    }

    app()->setLocale($locale);

    return $next($request);
}
}
