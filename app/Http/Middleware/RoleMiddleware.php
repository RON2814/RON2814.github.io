<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role_id;

        // Redirect based on roles
        switch ($userRole) {
            case '1':
                if ($role !== 'student') {
                    return redirect()->route('dashboard');
                }
                break;

            case '2':
                if ($role !== 'department') {
                    return redirect()->route('department.dashboard');
                }
                break;

            case '3':
                if ($role !== 'registrar') {
                    return redirect()->route('registrar.dashboard');
                }
                break;

            case '4':
                if ($role !== 'admin') {
                    return redirect()->route('admin.dashboard');
                }
                break;

            default:
                return redirect()->route('login'); // Redirect unknown roles to login
        }

        return $next($request);
    }
}
