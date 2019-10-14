<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\JwtHelper;

class TeacherMiddleware
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
        $token = explode(' ', $request->header('Authorization'));
        $credentials = $request->credentials;

        if (! in_array('guru', $credentials->roles)) {
            return response()->json([
                'error' => [
                    'message' => 'Tidak memiliki akses untuk endpoint ini.'
                ]
            ], 403);
        }
        return $next($request);
    }
}
