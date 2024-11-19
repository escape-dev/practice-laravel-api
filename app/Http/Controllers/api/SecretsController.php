<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecretsController extends Controller
{
    public function index()
    {
        return $this->defaultResponse([
            'message' => 'Welcome',
            'data'    => null,
            'status'  => 200,
        ]);
    }
}
