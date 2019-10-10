<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Firebase\JWT\JWT;
use App\User;

class AuthController extends Controller
{
    public function __contruct()
    {
        
    }

    public function authenticate(Request $request)
    {
        $messages = [
            'required' => ':attribute harus diisi'
        ];
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ], $messages);
        $errors = $validator->errors();

        if ($errors->has('username') || $errors->has('password')) {
            return response()->json([
                'error' => [
                    'message' => $errors->all()
                ]
            ], 422);
        }

        $user = User::with('roles')->where('username', $request->input('username'))->firstOrFail();
        if (password_verify($request->input('password'), $user->password)) {
            $roleName = [];
            foreach($user->roles as $role) {
                array_push($roleName, $role->name);
            }

            $payload = [
                'user_id' => $user->id,
                'username' => $user->username,
                'roles' => $roleName
            ];
            $exp = time() + env('JWT_EXP');
            return response()->json([
                'token' => $this->generateToken($payload, $user->username, $exp),
                'expires_in' => $exp
            ]);
        } else {
            return response()->json([
                'error' => [
                    'message' => 'Password salah'
                ]
            ], 400);
        }
    }

    protected function generateToken($payload, $subject, $expire_time) 
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
}
