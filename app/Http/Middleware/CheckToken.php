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
        else if($request->bearerToken())
        {
            $user = auth('sanctum')->user();
            if($user == null)
            {
                return JsonFormatter::error("Unauthorized. Token rusak atau tidak sesuai.", code: 401);
            }
        }

        return $next($request);
    }
}
