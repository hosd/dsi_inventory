<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SessionModel;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Log out from all other devices
        Auth::logoutOtherDevices($request->password);

        // Retrieve the user's stored session IDs from the database
        $storedSessionIds = SessionModel::where('user_id', Auth::id())->pluck('session_id');

        // Get the current session ID
        $currentSessionId = $request->session()->getId();

        // Delete old session records except for the current session
        SessionModel::where('user_id', Auth::id())
                    ->whereNotIn('session_id', [$currentSessionId])
                    ->delete();

        // Update or create a new session record for the current session
        SessionModel::updateOrCreate(['user_id' => Auth::id()], ['session_id' => $currentSessionId]);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        SessionModel::where('user_id', Auth::id())->delete();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
