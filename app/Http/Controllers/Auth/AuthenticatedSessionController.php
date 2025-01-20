<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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
        // Check if the 'remember' checkbox was checked
        $remember = $request->filled('remember');  // This will return true if 'remember' is checked, false otherwise.

        // Determine if the input is an email or user ID
        $loginField = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'id';

        // Validate the login field
        $validator = Validator::make($request->all(), [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages([
                'login' => [trans('auth.failed')],
            ]);
        }

        // Authenticate the user with 'remember' flag
        if (Auth::attempt([$loginField => $request->input('login'), 'password' => $request->input('password')], $remember)) {
            // Regenerate the session to avoid session fixation
            $request->session()->regenerate();

            // Get the logged-in user's role
            $loggedInUserRole = $request->user()->role_id;

            // Redirect based on user role
            return match ($loggedInUserRole) {
                '1' => redirect()->intended(route('dashboard', false)),
                '2' => redirect()->intended(route('department.dashboard', false)),
                '3' => redirect()->intended(route('registrar.dashboard', false)),
                '4' => redirect()->intended(route('admin.dashboard', false)),
                default => redirect()->intended(route('index', false)),
            };
        }

        // If authentication fails, throw a validation exception
        throw ValidationException::withMessages([
            'login' => [trans('auth.failed')],
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout the user
        Auth::guard('web')->logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
