<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/* 
Com um middleware nós podemos interceptar a requisição antes de chegar ao controller ou 
a resposta depois dela ser retornada pelo controller. Inclusive nós podemos ter vários 
middlewares sendo executados. */

class Authenticator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(!Auth::check()){
            throw new AuthenticationException();
        }

        return $next($request);
    }
}
