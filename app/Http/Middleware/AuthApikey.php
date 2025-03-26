<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthApikey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('api-key');
        $api_key_env = env('APP_KEY');
        if ($apiKey !== 'Bearer ' . $api_key_env) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
