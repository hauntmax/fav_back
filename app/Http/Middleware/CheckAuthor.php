<?php

namespace App\Http\Middleware;

use App\Abstract\Authorable;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthor
{
    public function handle(Request $request, Closure $next)
    {
        foreach ($request->route()->parameters as $parameter) {
            if ($parameter instanceof Authorable) {
                if ($parameter->getAuthorIdentifier() !== $request->user()?->getAuthIdentifier()) {
                    abort(Response::HTTP_FORBIDDEN);
                }
            }
        }

        return $next($request);
    }
}
