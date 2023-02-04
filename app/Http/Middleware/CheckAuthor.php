<?php

namespace App\Http\Middleware;

use App\Models\Category;
use Closure;
use Illuminate\Http\Request;

class CheckAuthor
{
    public function handle(Request $request, Closure $next)
    {
        /** @var Category $category */
        $category = $request->category;
        if ($category->user_id !== $request->user()?->getAuthIdentifier()) {
            abort(403);
        }

        return $next($request);
    }
}
