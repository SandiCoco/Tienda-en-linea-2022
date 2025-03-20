<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Cupon;
use App\Models\Historial;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Wish;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAuth = Auth()->user();

        if($userAuth->rol == 'Administrador'){
            $users = User::all();
            return view('admin.index')->with('Users', $users);
        }
        else{
            return back();
        }
    }

    public function cupons(){

        $userAuth = Auth()->user();

        if($userAuth->rol == 'Administrador'){
            $cupons = Cupon::all();
            return view('admin.cupons')->with('cupons', $cupons);
        }
        else{
            return back();
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $userAuth = Auth()->user();

        if($userAuth->rol == 'Administrador'){
            return view('admin.editUser')->with('User', $user);
        }
        else{
            return back();
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        if($request->hasFile('foto')){

            $file = $request->file('foto');//obtenemos el archivo
            $name = $file->getClientOriginalName();//obtenemos el nombre del archivo

            $rutaImagen = $file->storeAs('imagenes', $name , [ 'disk' => 'public' ]);//guardamos el archivo en la carpeta publica

            if($user->foto == null)
            {
                $user->foto = $rutaImagen;
            }
            else
            {
                Storage::disk('public')->delete($user->foto);
                $user->foto = $rutaImagen;
            }

        }

        $data = $request->only(['nombre', 'apellido', 'correo','password','pais','direccion','direccion_envio','rol']);
        $user['foto'] = $user->foto;
        $data['rol'] = $request->rol;
        $data['password'] = bcrypt($request->password);
        $user->update($data);

        return redirect()->back()->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy ($user)
    {
        $usuario = User::find($user);
        $historial = Historial::where('usuario_id', $user)->get();
        $carrito =  Carrito::where('usuario_id', $user)->get();
        $wish = wish::where('usuario_id', $user)->get();

        if($usuario->foto)
        {
            Storage::disk('public')->delete($usuario->foto);
        }

        foreach($historial as $h)
        {
            $h->delete();
        }

        foreach($carrito as $c)
        {
            $c->delete();
        }

        foreach($wish as $w)
        {
            $w->delete();
        }


        $usuario->delete();
        return redirect()->back()->with('success', 'Usuario eliminado con éxito');
    }
    
}
