<?php

namespace Ezadev\Admin\Middleware;

use Closure;
use Ezadev\Admin\Facades\Admin;
use Illuminate\Http\Request;

class Bootstrap
{
    public function handle(Request $request, Closure $next)
    {
        Admin::bootstrap();

        return $next($request);
    }
}
