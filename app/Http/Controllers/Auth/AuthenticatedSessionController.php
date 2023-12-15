<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
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
        $request->authenticate();

        $request->session()->regenerate();

        if ($request->user()->status == 'inactive') {
            if ($request->user()->role == 'admin') {
                Auth::guard('web')->logout();

                $request->session()->regenerateToken();

                toastr()->error('Tài khoản đã bị cấm', ' ');
                return redirect('/admin/login');
            } else {
                Auth::guard('web')->logout();

                $request->session()->regenerateToken();

                toastr()->error('Tài khoản đã bị cấm', ' ');
                return redirect('/login');
            }
        }

        $url = "";
        if ($request->user()->role == 'admin') {
            $url = '/admin/dashboard';
        } elseif ($request->user()->role == 'vendor') {
            $url = '/vendor/dashboard';
        } elseif ($request->user()->role == 'user') {
            $url = '/user/dashboard';
        }

        // Use yoeunes/toastr laravel
        toastr()->success('Đăng nhập thành công', ' ');
        return redirect()->intended($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Auth::guard('web')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        // toastr()->success('Logout successfully!');

        // return redirect('/');

        if (Auth::user()->role === 'admin') {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            toastr()->success('Đăng xuất thành công', ' ');

            return redirect('/admin/login');
        } elseif (Auth::user()->role === 'vendor' || Auth::user()->role === 'user') {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            toastr()->success('Đăng xuất thành công', ' ');

            return redirect('/login');
        }
    }
}
