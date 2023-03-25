<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // 修正
use App\Models\SupportUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SupportUserLoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.suplogin');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse // 修正
    {
        $validated = $request->validated();

        $supportUser = SupportUser::where('email', $validated['email'])->first();

        if ($supportUser && \Hash::check($validated['password'], $supportUser->password)) {
            Auth::login($supportUser);
            $request->session()->regenerate();
            return redirect()->intended('/supuser/home');
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
        Auth::guard('support_user')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}