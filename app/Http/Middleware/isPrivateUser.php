<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isPrivateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //for error can't set id prop to null because no user logged in yet!!
        if (auth()->user() != null) {

            if ($request->id != auth()->user()->id) {

                $request->session()->flash('error_msg', "cant't do this action");
                return back();
            }
        } else {
            // FORBIDDEN page
            return abort(403);
        }
        return $next($request);
    }
}