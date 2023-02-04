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
        /** @var Authorable $category */
        $category = $request->category ;
        if ($category->getAuthorIdentifier() !== $request->user()?->getAuthIdentifier()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
