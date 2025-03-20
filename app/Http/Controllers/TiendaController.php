<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use App\Models\Tienda;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Wish;
use App\Models\Cupon;

class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        $user = User::where('id','2')->first();
        return view('tienda.tienda')->with('productos', $productos)->with('user', $user);
    }

    public function indexAuth()
    {
        
        $user = User::find(Auth::user()->id);
        $productos = Producto::all();
        $wish = Wish::where('usuario_id', $user->id)->get();
        return view('tienda.tiendaAuth')->with('User', $user)->with('productos', $productos)->with('wish', $wish);

    }

    public function buscar(Request $request){
        
        $auth = Auth::user();

        if($auth == null)
        {
            $user = User::where('id','2')->first();
            $productos = Producto::where('nombre', 'like', '%'.$request->buscar.'%')
            ->orWhere('categoria', 'like', '%'.$request->buscar.'%')
            ->orWhere('precio_venta', 'like', '%'.$request->buscar.'%')
            ->get();
            return view('tienda.tienda')->with('productos', $productos)->with('user', $user);
        }
        else
        {
            $user = User::find(Auth::user()->id);
            $productos = Producto::where('nombre', 'like', '%'.$request->buscar.'%')
            ->orWhere('categoria', 'like', '%'.$request->buscar.'%')
            ->orWhere('precio_venta', 'like', '%'.$request->buscar.'%')
            ->get();
            $wish = Wish::where('usuario_id', $user->id)->get();
            return view('tienda.tiendaAuth')->with('User', $user)->with('productos', $productos)->with('wish', $wish);
        }

        
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {
        return view('registerUser');
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
     * @param  \App\Models\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function show(Tienda $tienda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario  = User::find(Auth::user()->id);
        return view('tienda.user', compact('usuario'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, User $usuario)
    {
        

        User::updateOrCreate(
            [
                'id' => $usuario->id
            ],
            [
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'correo' => $request->correo,
                'usuario' => $request->usuario,
                'password' => $request->password,
                'pais' => $request->pais,
                'direccion' => $request->direccion,
                'direccion_envio' => $request->direccion_envio,
                'foto' => $request->foto,
            ]);

        return redirect()->route('tienda.Auth')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tienda $tienda)
    {
        //
    }


    public function historial($id)
    {
        $usuario = User::find($id);
        $historial = Historial::where('usuario_id', $id)->get();
        $producto = Producto::all();
        return view('tienda.historial')->with('historial', $historial)->with('usuario', $usuario)->with('producto', $producto);
    }

    public function destroyHistorial($id){
        $historial = Historial::find($id);
        $historial->delete();
        return redirect()->route('tienda.historial', $historial->usuario_id)->with('success', 'Historial eliminado correctamente');
    }

    public function wish($id)
    {
        $usuario = User::find($id);
        $wish = Wish::where('usuario_id', $id)->get();
        $producto = Producto::all();
        return view('wish.index')->with('usuario', $usuario)->with('wish', $wish)->with('producto', $producto);
    }

    public function cupon(){
        $cupons = Cupon::all();
        return view('cupons.cupons')->with('cupons', $cupons);
    }

    public function cuponCreate(){
        return view('cupons.create');
    }
    
    public function addWish(Request $request)
    {

        Wish::create([
            'usuario_id' => $request->usuario_id,
            'producto_id' => $request->producto_id,
        ]);

        return redirect()->route('tienda.Auth')->with('success', 'Producto agregado a la lista de deseos');

    }

    public function deleteWish($id)
    {
        $wish = Wish::find($id);
        $wish->delete();
        return redirect()->back()->with('success', 'Producto eliminado de la lista de deseos');
    }

    public function showProducto($id)
    {
        $auth = Auth::user();

        if($auth == null)
        {
            $User = User::where('id','2')->first();
        }
        else
        {
            $User = User::find(Auth::user()->id);
        }
        $producto = Producto::find($id);
        return view('tienda.productoUnico')->with('producto', $producto)->with('User', $User);
    }




}
