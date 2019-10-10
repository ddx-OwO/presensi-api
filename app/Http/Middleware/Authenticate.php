<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class Authenticate
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = explode(' ', $request->header('Authorization'));
        
        if(!$request->header('Authorization')) {
            // Unauthorized response if token not there
            return response()->json([
                'error' => [
                    'message' => 'Tidak mememiliki akses login'
                ]
            ], 401);
        }

        try {
            $credentials = JWT::decode($token[1], env('JWT_SECRET'), ['HS256']);
        } catch(ExpiredException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Sesi login sudah kadaluarsa. Silakan login kembali.'
                ]
            ], 400);
        } catch(Exception $e) {
            return response()->json([
                'error' => [
                    'message' => $e->getMessage()
                ]
            ], 400);
        }
        $user = User::find($credentials->sub);
        // Now let's put the user in the request class so that you can grab it from there
        $request->auth = $user;
        return $next($request);
    }
}
