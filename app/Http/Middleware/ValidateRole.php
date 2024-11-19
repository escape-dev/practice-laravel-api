<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        if (in_array(auth('api')->user()->role->value, $role)) {
            return $next($request);
        }

        return response()->json([
            'message' => "Where are you?",
            'data' => null,
        ], Response::HTTP_FORBIDDEN);

    }
}
