<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Historial;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Cupon;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $auth = Auth::user();

        if($auth == null)//si no hay usuario logeado
        {
            $user = User::where('id','2')->first();//usuario invitado
        }
        else
        {
            $user = User::find(Auth::user()->id);
        }

        $carrito = Carrito::where('usuario_id', $user->id)->get();
        $producto = Producto::all();
        $cupons = Cupon::all();
        return view('tienda.carrito')->with('carrito', $carrito)->with('producto', $producto)->with('user', $user)->with('cupons', $cupons);
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

        Carrito::create([
            'producto_id' => $request->producto_id,
            'usuario_id' => $request->usuario_id,
            'cantidad' => $request->cantidad,
        ]);

        return redirect()->back()->with('success', 'Producto agregado al carrito');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function show(Carrito $carrito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function edit(Carrito $carrito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carrito $carrito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function destroy($carrito)
    {

        $carrito = Carrito::find($carrito);
        $carrito->delete();
        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }

    public function comprar(Request $request)
    {

        $user = auth()->user();

        if($user == null)
        {
            $user = User::where('id','2')->first();
        }
        else
        {
            $user = User::find(Auth::user()->id);
        }

        $request->validate([
            'direccion_envio' => 'required',
        ],[
            'direccion_envio.required' => 'La dirección de envío es requerida',
        ]);

        $cupons = Cupon::all();

        if($request->total == 0){
            return redirect()->back()->with('error', 'No hay productos en el carrito');
        }
        else
        { 
            $productos = $request->producto_id;
            $cantidad = $request->cantidad;

            for ($i=0; $i < count($productos) ; $i++) { 
                $producto = Producto::find($productos[$i]);
                if($producto->stock < $cantidad[$i]){
                    return redirect()->back()->with('error', 'No hay suficiente stock del producto '.$producto->nombre);
                }
                $producto->stock = $producto->stock - $cantidad[$i];
                $producto->save();
            }
            if($user->referido == true && $user->nuevo == true)//Si el usuario es referido y es nuevo
            {

                foreach($cupons as $cupon)//Si el usuario tiene un cupon
                    {
                        if($cupon->code == $request->cupon){
                            $total = $request->total - ($request->total * ($cupon->descuento)/100);
                            $total = $total - ($total * 0.15);

                            Historial::create([
                                'usuario_id' => $request->usuario_id,
                                'total' => $total - 2,
                                'direccion_envio' => $request->direccion_envio,
                            ]);
                            
                            Carrito::where('usuario_id', $request->usuario_id)->delete();
                            User::where('id', $request->usuario_id)->update(['nuevo' => false]);
                            return redirect()->back()->with('success', 'Compra realizada con exito');
                        }
                    }

                
                
                $data = $request->only(['total', 'usuario_id']);
                $data['total'] = $request->total - ($request->total * 0.15) - 2;
                $data['usuario_id'] = $request->usuario_id;
                $data['direccion_envio'] = $request->direccion_envio;

                Historial::create($data);
                User::where('id', $request->usuario_id)->update(['referido' => false]);
                User::where('id', $request->usuario_id)->update(['nuevo' => false]);
                Carrito::where('usuario_id', $request->usuario_id)->delete();

                return redirect()->back()->with('success', 'Compra realizada');
                        
            }

            if($user->nuevo == true)
            {

                foreach($cupons as $cupon)//Si el usuario no es referido y es nuevo
                    {
                        if($cupon->code == $request->cupon){//Si tiene cupon
                            $total = $request->total - ($request->total * ($cupon->descuento)/100);
                            $total = $total - ($total * 0.15);
                            Historial::create([
                                'usuario_id' => $request->usuario_id,
                                'total' => $total,
                                'direccion_envio' => $request->direccion_envio,
                            ]);
                        Carrito::where('usuario_id', $request->usuario_id)->delete();
                        User::where('id', $request->usuario_id)->update(['nuevo' => false]);
                        return redirect()->back()->with('success', 'Compra realizada con exito');
                        }
                    }
            

                $data = $request->only(['total', 'usuario_id']);
                $data['total'] = $request->total - ($request->total * 0.15);
                $data['usuario_id'] = $request->usuario_id;
                $data['direccion_envio'] = $request->direccion_envio;

                Historial::create($data);

                Carrito::where('usuario_id', $request->usuario_id)->delete();
                User::where('id', $request->usuario_id)->update(['nuevo' => false]);

                return redirect()->back()->with('success', 'Compra realizada');
            }

            foreach($cupons as $cupon)
                    {
                        if($cupon->code == $request->cupon){//Si tiene cupon
                            $total = $request->total - ($request->total * ($cupon->descuento)/100);
                            Historial::create([
                                'usuario_id' => $request->usuario_id,
                                'total' => $total,
                                'direccion_envio' => $request->direccion_envio,
                            ]);
                        Carrito::where('usuario_id', $request->usuario_id)->delete();
                        User::where('id', $request->usuario_id)->update(['nuevo' => false]);
                        return redirect()->back()->with('success', 'Compra realizada con exito');
                        }
                    }

            $data = $request->only(['total', 'usuario_id']);
            $data['total'] = $request->total;
            $data['usuario_id'] = $request->usuario_id;
            $data['direccion_envio'] = $request->direccion_envio;

            Historial::create($data);
            User::where('id', $request->usuario_id)->update(['nuevo' => false]);
            return redirect()->route('tienda.resumen', $user)->with('success', 'Compra realizada')->with('producto', $productos)->with('cantidad', $cantidad);
        }
    }

    public function resumen()
    {
        $user = Auth::user();
        $historial = Historial::where('usuario_id', $user->id)->get();
        $total = Historial::where('usuario_id', $user->id)->latest()->first();
        $cupons = Cupon::all();
        $carrito = Carrito::where('usuario_id', $user->id)->get();

        return view('tienda.resumen')->with('total',$total)->with('user', $user)->with('historial', $historial)->with('cupons', $cupons)->with('carrito', $carrito);
    }
}

