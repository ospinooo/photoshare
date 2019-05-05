<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (!$request->user() || !$request->user()->admin){
        return redirect('/')->with('error', 'Sorry you are not Admin');
      }

      return $next($request);
    }
}
