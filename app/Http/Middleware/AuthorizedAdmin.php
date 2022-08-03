<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class AuthorizedAdmin
{
    public function handle($request, Closure $next)
    {
        if (!$this->isAdmin($request)) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }

    protected function isAdmin($request)
    {
        return $request->user()->profil == 'admin';
    }
}