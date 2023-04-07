<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
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
        $ok = false;

        $current_user_role = Auth::user()->user_role;

        if($current_user_role <= 2){

            $ok = true;

        }

        if ($ok) {
            return $next($request);
        }

        return redirect()->back()->withErrors('No Correct Permission Contact Admin');
        

    }
}
