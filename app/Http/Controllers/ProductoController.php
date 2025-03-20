<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::latest()->get();
        $productos = json_encode($productos, JSON_PRETTY_PRINT);
        $contents = view('api.productos')->with('productos', $productos);
        $response = Response($contents, 200);
        $response->header('Content-Type', 'application/json');
        return $response;
    }

    public function indexProductos()
    {
        $userAuht = Auth()->user();

        if($userAuht->rol == 'Administrador'){
            $productos = Producto::all();
            return view('admin.indexProducto')->with('Productos', $productos);
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
        $userAuht = Auth()->user();

        if($userAuht->rol == 'Administrador'){
            return view('api.registerItem');
        }
        else{
            return back();
        }
        
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
            'codigo' => 'required|unique:productos',
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio_venta' => 'required|numeric',
            'stock' => 'required|numeric',
            'costo' => 'required|numeric',
            'proveedor' => 'required',
            'categoria' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5000',
        ],[
            'codigo.required' => 'El campo codigo es obligatorio',
            'codigo.unique' => 'El codigo ya existe',
            'nombre.required' => 'El campo nombre es obligatorio',
            'descripcion.required' => 'El campo descripcion es obligatorio',
            'precio_venta.required' => 'El campo precio de venta es obligatorio',
            'precio_venta.numeric' => 'El campo precio de venta debe ser numerico',
            'stock.required' => 'El campo stock es obligatorio',
            'stock.numeric' => 'El campo stock debe ser numerico',
            'costo.required' => 'El campo costo es obligatorio',
            'costo.numeric' => 'El campo costo debe ser numerico',
            'proveedor.required' => 'El campo proveedor es obligatorio',
            'categoria.required' => 'El campo categoria es obligatorio',
            'foto.required' => 'El campo foto es obligatorio',
            'foto.image' => 'El campo foto debe ser una imagen',
            'foto.mimes' => 'El campo foto debe ser una imagen con formato jpeg, png o jpg',
            'foto.max' => 'El campo foto debe ser una imagen con un tamaño maximo de 5MB',
        ]);

        $file = $request->file('foto');
        $name = $file->getClientOriginalName();

        $rutaImagen = $file->storeAs('imagenes', $name , [ 'disk' => 'public' ]);

        $data = $request->only('codigo', 'nombre', 'descripcion', 'precio_venta', 'stock', 'costo', 'proveedor', 'categoria');
        $data['foto'] = $rutaImagen;
        Producto::create($data);
    
        return redirect()->route('admin.indexProductos');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {

        $userAuht = Auth()->user();

        if($userAuht->rol == 'Administrador'){

            $producto = json_encode($producto, JSON_PRETTY_PRINT);
            $contents = view('api.producto')->with('producto', $producto);
            $response = Response($contents, 200);
            $response->header('Content-Type', 'application/json');
        return $response;

        }
        else{

            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        $userAuht = Auth()->user();

        if($userAuht->rol == 'Administrador'){
            return view('admin.editPro')->with('producto', $producto);
        }
        else{
            return back();
        }
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {

        if($request->hasFile('foto')){

            $file = $request->file('foto');//obtenemos el archivo
            $name = time().$file->getClientOriginalName();//obtenemos el nombre del archivo
            
            Storage::disk('public')->delete($producto->foto);//eliminamos la imagen anterior

            $rutaImagen = $file->storeAs('imagenes', $name , [ 'disk' => 'public' ]);//guardamos el archivo en la carpeta public

            $producto->foto = $rutaImagen;//actualizamos la ruta de la imagen

        }

        $data = $request->only('codigo', 'nombre', 'descripcion', 'costo', 'precio_venta', 'stock', 'categoria', 'proveedor');
        $producto['foto'] = $producto->foto;
        $producto->update($data);

        return redirect()->back()->with('status', 'Producto actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        if($producto->foto)
        {
            Storage::disk('public')->delete($producto->foto);
        }

        $producto->delete();
        return redirect()->back()->with('status', 'Producto eliminado con éxito');
    }
}
