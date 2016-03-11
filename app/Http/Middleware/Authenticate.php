<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $tipo)
    {
        //dd(Auth::user()->tipo);
        //Se não for admin volta pra login
        
       
        if ($this->auth->guest()) {
            //Se o usuário for comum ele volta pra pag de login
             
           
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                //Caso o usuário deseja acessar uma url e não estiver logado,
                //vai cair na página de login
                return redirect()->guest('login');
            }
        }
        
        if (Auth::user()->tipo <> $tipo) {
            return redirect('/logout');
        }
        return $next($request);
    }
}
