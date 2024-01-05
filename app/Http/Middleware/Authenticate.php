<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * @var array
     */
    protected $guards = [];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string[] ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        // Store the guards for later use
        $this->guards = $guards;

        // Call the parent handle method to perform the default authentication check
        return parent::handle($request, $next, ...$guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        // Check if the request expects JSON
        if (!$request->expectsJson()) {
            // If the first guard is 'api', redirect to the login route
            if (reset($this->guards) === 'api' || reset($this->guards) === 'web') {
                return route('login');
            } else {
                // If it's not 'api', redirect to the root and include a custom header
                return route('dealer-login');

            }
        }

        // If the request expects JSON, return a JSON response
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }
}
