<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
        public function store(LoginRequest $request): RedirectResponse
    {
        // ✅ Authenticate user
        $request->authenticate();

        // ✅ Regenerate session
        $request->session()->regenerate();

        // ✅ Redirect by role
        if(auth()->user()->role == 'admin')
        {
            return redirect()->route('admin.dashboard');
        }

        elseif(auth()->user()->role == 'staff')
        {
            return redirect()->route('staff.dashboard');
        }

        // ✅ Default redirect
        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
