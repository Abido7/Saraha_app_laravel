<?php

namespace App\Http\Middleware;

use App\Models\Message;
use Closure;
use Illuminate\Http\Request;

class OwenMessage
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

        if (auth()->user() !== null) {
            //  note use != instead of !== because $request->uId come as string but auth()->user()->id is anumber
            if (auth()->user()->id == $request->uId) {
                return $next($request);
            }
            return back();
        }
    }
}