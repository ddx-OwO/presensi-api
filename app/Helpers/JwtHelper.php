<?php

namespace App\Helpers;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtHelper
{
    /**
     * Membuat token JWT
     *
     * @param $payload array
     * @param $subject string
     * @param $expire_time int
     * @return string
     */
    public static function generateToken(array $payload, string $subject, int $expire_time)
    {
        $privateClaims = [
            'iss' => env('APP_URL'),
            'sub' => $subject,
            'exp' => time() + $expire_time,
            'iat' => time()
        ];
        $payload = array_merge($privateClaims, $payload);

        $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');
        return $jwt;
    }

    /**
     * Mendecode JWT dan menangkap error nya
     *
     * @param $token string
     * @return \Illuminate\Http\JsonResponse|string
     */
    public static function getTokenData($token)
    {
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
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

        return $credentials;
    }
}
