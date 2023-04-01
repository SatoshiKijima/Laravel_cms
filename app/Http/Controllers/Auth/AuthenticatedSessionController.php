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

        if ($user && \Hash::check($validated['password'], $user->password)) {
            Auth::login($user);

            $request->session()->regenerate();
            
            return redirect()->intended('/user/home');
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
            if (Auth::guard('supportusers')->check()) {
                Auth::guard('supportusers')->logout();
            } else if (Auth::guard('web')->check()) {
                Auth::guard('web')->logout();
            }
        
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        
            if (Auth::guard('supportusers')->check()) {
                return redirect('/support/home');
            } else {
                return redirect('/usergate');
            }
    }
    
    protected function afterLogoutResponse(Request $request): Response
        {
            if (Auth::guard('supportusers')->check()) {
                return redirect('/support/home');
            } else {
                return redirect('/usergate');
            }
        }
}
