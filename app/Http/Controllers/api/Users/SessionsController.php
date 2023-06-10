<?php

namespace App\Http\Controllers\Api\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;

class SessionsController extends Controller
{
    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->defaultResponse([
                'message' => $validator->errors(),
                'data'    => null,
                'status'  => 422,
            ]);
        }

        $credentials = $request->only('email', 'password');
        $token       = auth('api')->attempt($credentials);

        if (!$token) {
            return $this->defaultResponse([
                'message' => 'Invalid email or password',
                'data'    => null,
                'status'  => 401,
            ]);
        }

        return response()->json([
            'message' => 'Sign in successfully',
            'data'    => auth('api')->user()->userAttributes(),
            'token'   => $token,
        ], 200);
    }

    public function destroy(Request $request) 
    {
        $token = JWTAuth::invalidate(JWTAuth::getToken());

        return $this->defaultResponse([
            'message' => 'Sign out successfully',
            'data'    => null,
            'status'  => 200,
        ]);
    }
}
