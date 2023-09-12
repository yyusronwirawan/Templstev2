<?php

namespace App\Http\Middleware;

use App\Facades\UtilityFacades;
use App\Support\Google2FAAuthenticator;
use Closure;

class LoginSecurityMiddleware
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
        if (extension_loaded('imagick')) {
            if (UtilityFacades::getValByName('2fa') == '1') {
                $authenticator = app(Google2FAAuthenticator::class)->boot($request);
                if ($authenticator->isAuthenticated()) {
                    return $next($request);
                }
                return $authenticator->makeRequestOneTimePasswordResponse();
            } else {
                return $next($request);
            }
        } else {
            return $next($request);
        }
    }
}
