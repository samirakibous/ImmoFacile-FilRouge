<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // dd(auth()->user());
        if (!Auth::check()) {
            return redirect()->route('login'); // ou abort(403);
        }

        if (!in_array(auth()->user()->role->name, $roles)){
            abort(403, 'Accès interdit');
        }
        return $next($request);
    }
}
