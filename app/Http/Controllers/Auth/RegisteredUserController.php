<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
            [
                'password.confirmed' => 'Xác nhận mật khẩu không đúng.',
                'password.min' => 'Mật khẩu phải lớn hơn 8 ký tự.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'email.required' => 'Vui lòng nhập email.',
                'email.unique' => 'Địa chỉ email đã tồn tại.',
                'name.required' => 'Vui lòng nhập tên.',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        toastr()->success('Đăng ký thành công', ' ');
        return redirect('/user/dashboard');

        // return redirect(RouteServiceProvider::HOME);
    }
}
