<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateWithAuthService
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    //Authorize the user submitted token
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $response = Http::withToken($token)->post(env('AUTHENTICATION_URL').'/api/authenticate');
        if ($response->failed()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $request->attributes->add(['user' => $response->json()]);
        return $next($request);
    }
}
