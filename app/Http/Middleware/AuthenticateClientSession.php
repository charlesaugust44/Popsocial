<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Support\Facades\Auth;

class AuthenticateClientSession
{
    protected $auth;


    public function __construct(AuthFactory $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, $guard = null)
    {
        if (!isset($_SESSION['token']))
            return redirect('login');

        [$header, $payload] = getTokenData($_SESSION['token']);

        if ($payload->isAdmin)
            return redirect('admin');

        return $next($request);
    }
}