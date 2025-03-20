<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>

    <nav>
        <a href="{{route('admin.indexProductos')}}"><button class="btn btn-primary btn-block ms-2 mt-2">Regresar</button></a>
    </nav>

    <!-- EDITAR PRODUCTO DESDE ADMIN -->

    <div class="container d-flex justify-content-center mt-3">
        <div class="card" style="width: 30rem;">
            <div class="card-body">
                <form action="{{route('admin.productoUpdate', $producto->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                        <div>
                            <h1>Datos de producto</h1>
                        </div>
                    @csrf

                    <div class="form-group mt-2">
                    <img src="{{asset('storage').'/'.$producto->foto}}" alt="auto" width="100">
                    </div>

                    <div class="form-group mt-2">
                    <label for="codigo">Codigo</label>
                    <input class="form-control" type="text" name="codigo" id="codigo" value="{{$producto->codigo}}">
                    </div>

                    <div class="form-group mt-2">
                    <label for="nombre">Nombre</label>
                    <input class="form-control" type="text" name="nombre" id="nombre" value="{{$producto->nombre}}">
                    </div>

                    <div class="form-group mt-2">
                    <label for="descripcion">Descripcion</label>
                    <input class="form-control" type="text" name="dexcripcion" id="descripcion" value="{{$producto->descripcion}}">
                    </div>

                    <div class="form-group mt-2">
                    <label for="proveedor">Proveedor</label>
                    <input class="form-control" type="text" name="proveedor" id="proveedor" value="{{$producto->proveedor}}">
                    </div>

                    <div class="form-group mt-2">
                    <label for="stock">Stock</label>
                    <input class="form-control" type="text" name="stock" id="stock" value="{{$producto->stock}}">
                    </div>

                    <div class="form-group mt-2">
                    <label for="costo">Costo</label>
                    <input class="form-control" type="text" name="costo" id="costo" value="{{$producto->costo}}">
                    </div>

                    <div class="form-group mt-2">
                    <label for="precio_venta">Precio de venta</label>
                    <input class="form-control" type="text" name="precio_venta" id="precio_venta" value="{{$producto->precio_venta}}">
                    </div>

                    <div class="form-group mt-2">
                    <label for="categoria">Categoria</label>
                    <input class="form-control" type="text" name="categoria" id="categoria" value="{{$producto->categoria}}">
                    </div>

                    <div class="form-group mt-2">
                    <label for="foto">Foto</label>
                    <input class="form-control" type="file" name="foto" id="foto" accept="image/*" value="{{$producto->foto}}">
                    </div>


                    <input type="submit" value="Guardar" class="form-control mt-5 bg-primary text-white">

                    <div class="container ">
                    @if(session()->has('status'))
                        <div class="alert alert-success">
                            {{ session()->get('status') }}
                        </div>
                    @endif
                </form> 
            </div>
        </div>
    </div>

 <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>