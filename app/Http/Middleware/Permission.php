<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $authGuard = app('auth')->guard('sanctum');
        $permission = $request->route()->getName();

        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        } else if(auth()->user()->is_super_admin || $authGuard->user()->can($permission)) {
            return $next($request);
        }

        throw UnauthorizedException::forPermissions([$permission]);
    }
}
