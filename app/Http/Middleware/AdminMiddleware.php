<?php

namespace App\Http\Middleware;

use Closure;
use Auth;



class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) //redirects user to correct page based on role
    {
      if (Auth::user()){
        if(Auth::user()->is_admin){
          return $next($request);
        }
        return redirect('booksLoggedIn');
      }
      return redirect('login');

    }
}
