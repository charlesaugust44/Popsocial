<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Support\Facades\Auth;

class AuthenticateClient
{
    protected $auth;


    public function __construct(AuthFactory $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, $guard = null)
    {
        $user = Auth::user();
        if (!$user || $user->isAdmin) {
            return response("Unauthorized", 401);
        }

        return $next($request);
    }
}