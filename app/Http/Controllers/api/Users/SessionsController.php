<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\SessionsStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpFoundation\Response;

class SessionsController extends Controller
{
    public function store(SessionsStoreRequest $request) 
    {
        $request->validated();

        $credentials = $request->only('email', 'password');
        $token       = auth('api')->attempt($credentials);

        if (!$token) {
            return $this->defaultResponse([
                'message' => 'Invalid email or password',
                'data'    => null,
                'status'  => Response::HTTP_UNAUTHORIZED ,
            ]);
        }

        return response()->json([
            'message' => 'Sign in successfully',
            'data'    => auth('api')->user()->userAttributes(),
            'token'   => $token,
        ], Response::HTTP_OK);
    }

    public function destroy(Request $request) 
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return $this->defaultResponse([
            'message' => 'Sign out successfully',
            'data'    => null,
            'status'  => Response::HTTP_OK,
        ]);
    }
}
