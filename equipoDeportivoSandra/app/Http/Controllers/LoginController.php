<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function signupForm(): View
    {
        return view('auth.signup');
    }

    public function signup(SignupRequest $request): RedirectResponse
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->birthday = $request->get('birthday');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        Auth::login($user);
        return redirect()->route('index');
    }

    public function loginForm()
    {
        if (Auth::check()) {
            // Puedes redirigir a la página principal con un mensaje o simplemente a la ruta 'index'.
            return redirect()->route('index')->with('message', 'Ya estás logueado');
        } else {
            return view('auth.login');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email','password');

        if(Auth::guard('web')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('index');

        } else {
            $error = 'Error al acceder a la aplicación';
            return view('auth.login',compact('error'));
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
