<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\SupportUser;

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
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();
        $is_support_user = false;

        if (!$user) {
            $user = SupportUser::where('email', $validated['email'])->first();
            $is_support_user = true;
        }

        if ($user && \Hash::check($validated['password'], $user->password)) {
            Auth::login($user);

            $request->session()->regenerate();

            if ($is_support_user) {
                return redirect()->intended('/supuser/home');
            } else {
                return redirect()->intended('/user/home');
            }
        }

        return back()->withErrors([
            'email' => '該当のユーザーは登録されておりません',
        ]);
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
