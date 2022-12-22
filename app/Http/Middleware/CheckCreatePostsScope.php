<?php

namespace App\Http\Middleware;

use Closure;

class CheckCreatePostsScope
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
        switch ($request->method()) {
            case 'POST':
                if (! $request->user()->tokenCan('create')) {
                    return response()->json(['error' => 'Unauthorized'], 403);
                }
                break;
            case 'DELETE':
                if (! $request->user()->tokenCan('delete')) {
                    return response()->json(['error' => 'Unauthorized'], 403);
                }
                break;
            case 'PUT':
                if (! $request->user()->tokenCan('update')) {
                    return response()->json(['error' => 'Unauthorized'], 403);
                }
                break;
            case 'GET':
                if (! $request->user()->tokenCan('read')) {
                    return response()->json(['error' => 'Unauthorized'], 403);
                }
                break;
        }        

        return $next($request);
    }
}
