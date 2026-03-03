<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class PreventDuplicateSubmission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Asegura que el usuario esté autenticado
        $userId = auth()->check() ? auth()->id() : $request->ip();

        // Creamos una clave única basada en el usuario y la URL del formulario
        $key = 'submit-lock:user:' . $userId . ':url:' . md5($request->url());

        if (Cache::has($key)) {
            return redirect()->back()->withErrors(['error' => 'Ya estás enviando el formulario. Espera unos segundos.']);
        }

        // Bloquea la clave por 5 segundos (puedes ajustar)
        Cache::put($key, true, now()->addSeconds(5));

        return $next($request);
    }
}
