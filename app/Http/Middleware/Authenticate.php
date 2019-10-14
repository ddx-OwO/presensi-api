<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Helpers\JwtHelper;

class Authenticate
{
    public function handle($request, Closure $next, $guard = null)
    {
        if(!$request->header('Authorization')) {
            // Unauthorized response if token not there
            return response()->json([
                'error' => [
                    'message' => 'Tidak mememiliki akses login'
                ]
            ], 401);
        }

        $token = explode(' ', $request->header('Authorization'));
        $credentials = JWTHelper::getTokenData($token[1]);

        if ($credentials instanceof \Illuminate\Http\JsonResponse) {
            return $credentials;
        }

        $user = User::find($credentials->user_id);
        // Now let's put the user and credentials in the request class
        // so that you can grab it from there
        $request->auth = $user;
        $request->credentials = $credentials;
        return $next($request);
    }
}
