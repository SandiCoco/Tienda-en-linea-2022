<?php
use App\Models\Producto;
use App\Models\Carrito;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>Resumen</title>
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1>Resumen de compra</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($carrito as $item)
                            @php
                                $producto = Producto::where('id', $item->producto_id)->get();
                            @endphp

                            @foreach($producto as $pro)
                                @if($item->producto_id == $pro->id)
                                    <tr>
                                        <td>{{$pro->nombre}}</td>
                                        <td>{{$item->cantidad}}</td>
                                        <td>{{$pro->precio_venta}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3">
                <h3>Total: {{ $total->total }}</h3>
                @php
                function generateRandomString($length = 10) {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    return $randomString;
                }
                @endphp
                <p>Codigo de rastreo de orden: {{generateRandomString()}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('tienda.Auth') }}" class="btn btn-primary mt-3">Volver</a>
            </div>
        </div>
    </div>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>

<?php
Carrito::where('usuario_id', $user->id)->delete();