<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>{{$producto->nombre}}</title>
</head>
<body>

@if (Route::has('login'))
@auth
<nav class="navbar navbar-expand-lg navbar-light bg-light" >
        <a href="{{route('tienda.Auth')}}"><button  class="btn btn-primary btn-block ms-2">Regresar</button></a>
    </nav>
    
    @else
    <nav class="navbar navbar-expand-lg navbar-light bg-light" >
        <a href="{{route('tienda.index')}}"><button  class="btn btn-primary btn-block ms-2">Regresar</button></a>
    </nav>
    @endauth
    @endif

    <div class="container d-flex justify-content-center mt-5">
        <div class="card" style="width: 35rem;">
            <img class="card-img-top" src="{{asset('storage').'/'.$producto->foto}}" alt="500" width="500">
                <div class="card-body">
                <h1>{{$producto->nombre}}</h1>
                <p>Codigo: {{$producto->codigo}}</p>
                <p>Descripcion: {{$producto->descripcion}}</p>
                <p>Precio: ${{$producto->precio_venta}}</p>
                <p>Stock: {{$producto->stock}}</p>
                <p>Categoria: {{$producto->categoria}}</p>
            

            <form action="{{route('tienda.addCarrito')}}" method="POST">

                                            @csrf
                                            <input type="hidden" name="producto_id" value="{{$producto->id}}">
                                            <input type="hidden" name="usuario_id" value="{{$User->id}}">
                                            <input type="number" name="cantidad" value="1" min="1" max="10" class="form-control">                                        
                                            <button type="submit" class="btn btn-primary mt-2">Añadir al carrito</button>
                                        </form>


            <form action="{{route('tienda.addWish')}}" method="POST">

                @csrf
                <input type="hidden" name="producto_id" value="{{$producto->id}}">
                <input type="hidden" name="usuario_id" value="{{$User->id}}">

                <button type="submit" class="btn btn-primary mt-2">Añadir a la lista de deseos</button>
            </form>
            </div>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>