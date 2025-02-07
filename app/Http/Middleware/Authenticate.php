<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // This is for web requests, if you have any.  You can customize this.
            return route('login'); // Or wherever your login route is.
        } else {
            // This is the important part for API requests.
             abort(response()->json(['error' => 'Unauthenticated.'], 401)); // Corrected response
        }
    }
}
