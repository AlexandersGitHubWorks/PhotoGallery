<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Schema;

class UserHasTableMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Schema::hasTable('users')) {
            return redirect()->route('register')->with('message', 'Please create a table of users in the database or use migrations');
        }
        return $next($request);
    }
}
