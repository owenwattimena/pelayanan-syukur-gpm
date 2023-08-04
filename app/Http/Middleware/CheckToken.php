<?php
namespace App\Http\Middleware;

use App\Helpers\JsonFormatter;
use Closure;
use Illuminate\Auth\Middleware\Authenticate;

class CheckToken extends Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (!$request->bearerToken()) {
            return JsonFormatter::error("Unauthorized. Token hilang atau kosong.", code: 401);
        }

        return $next($request);
    }
}
