<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as BaseMiddleware;
use Closure;
use Illuminate\Http\Request;

class EnsureFrontendRequestsAreStateful extends BaseMiddleware
{
    /**
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/*',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return parent::handle($request, $next);
    }
}