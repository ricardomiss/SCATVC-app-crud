<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Si las credenciales son válidas, redirigir al usuario a su página de inicio
            return redirect()->intended('home');
        }

        // Si las credenciales no son válidas, redirigir de nuevo al formulario de inicio de sesión
        return back()->withErrors(['email' => 'Estas credenciales no coinciden con nuestros registros.']);
    }
}
