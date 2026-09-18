<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(
        Request $request,
        Closure $next,
        string $permission
    ): Response {

        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $permissions = explode('|', $permission);
        if (count($permissions) > 1) {
            if (!$user->hasAnyPermission($permissions)) {
                return response()->json([
                    'message' => 'Vous n\'avez pas la permission nécessaire.'
                ], 403);
            }
        } else {
            if (!$user->hasPermission($permission)) {
                return response()->json([
                    'message' => 'Vous n\'avez pas la permission nécessaire.'
                ], 403);
            }
        }

        return $next($request);
    }
}
