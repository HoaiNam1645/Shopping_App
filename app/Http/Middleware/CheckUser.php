<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth('users')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 403,
                'message' => 'Bạn không được phép đi tuyến đường này',
            ], 403);
        }

        $request->attributes->set('user_id', $request->user('users')->id);
        return $next($request);
    }
}
