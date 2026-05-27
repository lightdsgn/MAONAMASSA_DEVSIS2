<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckTipo
{
    public function handle(Request $request, Closure $next, string ...$tipos): Response
    {
        if (!Auth::check() || !in_array(Auth::user()->tipo, $tipos)) {
            abort(403, 'Acesso negado. Você não tem permissão para esta área.');
        }

        return $next($request);
    }
}
