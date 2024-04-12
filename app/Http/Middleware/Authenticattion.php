<?php

namespace App\Http\Middleware;

use Closure;

class Authenticattion
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
        if (!$request->session()->has('token')) {
            return redirect('/login2');
        }

        // Clear browser cache for pages that shouldn't be accessible after logout
        $response = $next($request);

        // If user is not authenticated and the response is for a page that should be protected,
        // add headers to prevent caching
        if (!$request->session()->has('token') && $this->shouldProtect($request)) {
            $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
            $response->header('Pragma', 'no-cache');
            $response->header('Expires', '0');
        }

        return $response;
    }

    /**
     * Determine if the request is for a page that should be protected.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    private function shouldProtect($request)
    {
        // Define routes that should be protected after logout
        $protectedRoutes = [
            'home', // Add other route names as needed
        ];

        return in_array($request->route()->getName(), $protectedRoutes);
    }
}
