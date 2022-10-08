<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckHasCustomerData
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
        if (empty($request->session()->get('customerData'))) {
            return redirect()->route('book.index');
        }
        return $next($request);
    }
}
