<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class userAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('api')->check()) {
                // if ($request->ajax() || $request->wantsJson()) {
                //     return response()->json(['success' => false, 'data' => ['message' => 'Unauthorized.']], 401);
                // }
        }else{
            return response()->json(['success' => false, 'data' => ['message' => 'Unauthorized.']], 401);
        }
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');
        $response->headers->set('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Pragma', 'no-cache'); //HTTP 1.0
        $response->headers->set('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT'); // Date in the past

        return $response;
    }
}
