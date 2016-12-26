<?php

namespace App\Http\Middleware;

use Closure;

class checknum
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
        //echo $request->input('age');exit;
        if ($request->input('age') <= 1) {
            return redirect('http://www.baidu.com');
        }
        //echo 234;
        return $next($request);
    }
}
