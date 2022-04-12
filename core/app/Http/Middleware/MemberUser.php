<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class MemberUser
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
          if(Auth::user()->user_type == 'member')
          {
              return $next($request);
          }
          $notify[] = ["error", "Journalist can't access this page."];
          return back()->withNotify($notify);

    }
}
