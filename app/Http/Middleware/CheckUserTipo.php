<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserTipo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $tipo)
    {
        //confere se o usuário não está logado está logado
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        if (Auth::user()->tipo <> $tipo) {
            return redirect('/logout');
        }
        

        return $next($request);
    }
}
