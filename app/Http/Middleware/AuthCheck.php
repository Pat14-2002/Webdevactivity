<?php
   
   namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('loginId')) {
            return redirect()->route('auth.index')->with('fail', 'You need to be logged in.');
        }

        // Ensure PUT request is allowed for authenticated users only
        if ($request->isMethod('PUT') && !$request->routeIs('user.update')) {
            return redirect()->route('auth.index')->with('fail', 'Invalid request method.');
        }

        return $next($request);
    }
}
