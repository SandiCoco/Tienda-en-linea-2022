<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function register()
    {
        return view('Auth.register');
    }

    public function registerVerify(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|unique:users,correo',
            'usuario' => 'required|unique:users,usuario',
            'password' => 'required|min:8',
        ],[
            'nombre.required' => 'El nombre es requerido',
            'correo.required' => 'El correo es requerido',
            'correo.unique' => 'El correo ya existe',
            'usuario.required' => 'El usuario es requerido',
            'usuario.unique' => 'El usuario ya existe',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
        ]);

        User::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'usuario' => $request->usuario,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Usuario registrado correctamente');
    }
    
    public function registerReferred()
    {
        return view('Auth.registerReferred');
    }

    public function registerReferredVerify(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|unique:users,correo',
            'usuario' => 'required|unique:users,usuario',
            'password' => 'required|min:8',
        ],[
            'nombre.required' => 'El nombre es requerido',
            'correo.required' => 'El correo es requerido',
            'correo.unique' => 'El correo ya existe',
            'usuario.required' => 'El usuario es requerido',
            'usuario.unique' => 'El usuario ya existe',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
        ]);

        User::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'usuario' => $request->usuario,
            'password' => bcrypt($request->password),
            'referido' => true,
        ]);

        return redirect()->route('login')->with('success', 'Usuario registrado correctamente');
    }

    public function login()
    {
        return view('Auth.login');//retorna la vista login
    }

    public function loginVerify(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required|min:8',
        ],[
            'correo.required' => 'El correo es requerido',
            'correo.email' => 'El correo no es válido',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
        ]);

        if(Auth::attempt(['correo'=>$request->correo, 'password'=>$request->password]))
        {
            return redirect()->route('tienda.Auth');
        }

        return back()->withErrors(['Invalid_credentials' => 'Usuario o contraseña invalido'])->withInput();

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('tienda.index')->with('success','Sesion crerada correctamente');
    }
}