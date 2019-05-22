<?php

namespace App\Providers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function authenticateByToken($request)
    {
        if (!$request->exists('api_token'))
            return false;
        $token = $request->input('api_token');

        if ($token)
            return $this->authenticate($token);

        return null;
    }

    private function authenticate($token)
    {
        [$header, $payload, $signature] = explode(".", $token);

        if (token_expiration($payload))
            return null;

        $user = User::where('token', $token)->first();

        if ($user == null)
            return null;

        $serverSignature = hash_hmac('sha256', "$header.$payload", $user->secret, true);
        $serverSignature = base64_encode($serverSignature);

        if ($signature == $serverSignature)
            return $user;
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        session_start();

        $result = false;

        $this->app['auth']->viaRequest('api', function (Request $request) use (&$path, &$result) {
            $path = $request->decodedPath();
            $result = $this->authenticateByToken($request);
            return $result;
        });


        if ($result === false
            && isset($_SESSION['token'])) {

            $result = $this->authenticate($_SESSION['token']);

            if ($result === null)
                unset($_SESSION['token']);
        }
    }
}
