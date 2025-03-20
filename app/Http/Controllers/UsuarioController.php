<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::latest()->get();//obtiene todos los usuarios
        $usuarios = json_encode($usuarios, JSON_PRETTY_PRINT);//los convierte a json
        $contents = view('api.usuarios')->with('usuarios', $usuarios);//los envia a la vista
        $response = Response($contents, 200);//crea la respuesta
        $response->header('Content-Type', 'application/json');//le agrega el header
        return $response;//retorna la respuesta
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('api.registerUser');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email|unique:users',
            'usuario' => 'required|unique:users',
            'password' => 'required|min:8',
            'rol' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5000',
        ],[
            'nombre.required' => 'El campo nombre es obligatorio',
            'correo.required' => 'El campo correo es obligatorio',
            'correo.email' => 'El campo correo debe ser un correo válido',
            'correo.unique' => 'El correo ya está registrado',
            'usuario.required' => 'El campo usuario es obligatorio',
            'usuario.unique' => 'El usuario ya está registrado',
            'password.required' => 'El campo password es obligatorio',
            'rol.required' => 'El campo rol es obligatorio',
            'foto.required' => 'El campo foto es obligatorio',
            'foto.image' => 'El campo foto debe ser una imagen',
            'foto.mimes' => 'El campo foto debe ser una imagen con formato jpeg, png o jpg',
            'foto.max' => 'El campo foto debe ser una imagen con un tamaño máximo de 5MB',

        ]);

        $file = $request->file('foto');
        $name = $file->getClientOriginalName();

        $rutaImagen = $file->storeAs('imagenes', $name , [ 'disk' => 'public' ]);

        $data = $request->only('nombre','apellido','correo','usuario','password','rol','pais','direccion','direccion_envio');
        $data['foto'] = $rutaImagen;
        $data['password'] = bcrypt($data['password']);
        
        User::create($data);

        return redirect()->route('usuario.create')->with('success', 'Usuario creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        $usuario = json_encode($usuario, JSON_PRETTY_PRINT);
        $contents = view('api.usuario')->with('usuario', $usuario);
        $response = Response($contents, 200);
        $response->header('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        //
    }
}
