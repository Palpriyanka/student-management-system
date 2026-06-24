<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $permissions = session('permission_name', []);

        //  $currentUrl = trim($request->path(), '/');
        $currentRoute = $request->route()->getName();
        $permissions = session('permission_name', collect());
        //  dd($currentRoute);
        if ($permissions instanceof \Illuminate\Support\Collection) {
            $permissions = $permissions->toArray();
        }
        if (!in_array($currentRoute, $permissions)) {
            abort(403, 'Access Denied');
        }

        return $next($request);
    }
}
