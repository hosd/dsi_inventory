<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\DealerSessionModel;
use Carbon\Carbon;

class CheckDealerLastActivity
{
    public function handle($request, Closure $next)
    {
        // Check if user is authenticated
        if (Auth::check()) {
            // Get the stored session ID from the database
            $storedSessionId = DealerSessionModel::where('dealer_id', session('dealer_data.id'))->value('session_id');

            // Get the current session ID
            $currentSessionId = $request->session()->getId();

            // Check if stored session ID is not equal to the current session ID
            if ($storedSessionId !== $currentSessionId) {
                // Log the user out
                Auth::logout();

                // Clear all session data
                Session::flush();

                return redirect('dealer-login')->with('error', 'Your session has expired. Please log in again.');
            }

            // Check session lifetime
            $sessionLifetime = config('session.lifetime') * 60; // Convert minutes to seconds
            $sessionCreatedAt = Carbon::createFromTimestamp(DealerSessionModel::where('dealer_id', session('dealer_data.id'))->value('created_at')->getTimestamp());
            $currentTime = now();
            $sessionAge = $currentTime->diffInSeconds($sessionCreatedAt);

            if ($sessionAge > $sessionLifetime) {
                // Log the user out
                Auth::logout();

                // Clear all session data
                Session::flush();

                return redirect('dealer-login')->with('error', 'Your session has expired due to inactivity. Please log in again.');
            }

            // Update the stored session ID
            DealerSessionModel::updateOrCreate(['dealer_id' => session('dealer_data.id')], ['session_id' => $currentSessionId]);
        }

        return $next($request);
    }
}
