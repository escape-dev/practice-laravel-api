<?php

namespace App\Http\Controllers\Api\Users;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $request->validated();

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return $this->defaultResponse([
            'message' => 'user has been created',
            'data'    => $user->userAttributes(),
            'status'  => Response::HTTP_CREATED,
        ]);
    }
}
