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

<nav class="navbar navbar-expand-lg navbar-light bg-light" >
        <a href="{{route('tienda.Auth')}}"><button  class="btn btn-primary btn-block ms-2">Regresar</button></a>
    </nav>
<div class="container mt-3">
<h1>Lista de deseos de: {{$usuario->nombre}}</h1>

<div class="container d-flex mt-3">
       
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Producto</th>
      <th scope="col">Foto</th>
      <th scope="col">Nombre</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($wish as $deseo)
    <tr>
     @foreach ($producto as $pro)
     <tr>

      @if($deseo->producto_id == $pro->id)
        <th scope="row">{{$pro->id}}</th>
        <td><img src="{{asset('storage').'/'.$pro->foto}}" alt="" width="100"></td>
        <td>{{$pro->nombre}}</td>
        <td>
          <form action="{{route('tienda.deleteWish', $deseo->id)}}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger mb-2" style="width:8.8rem;">Eliminar</button>
          </form>
          <form action="{{route('tienda.addCarrito')}}" method="POST" class="">
               @csrf
              <input type="hidden" name="producto_id" value="{{$pro->id}}">
              <input type="hidden" name="usuario_id" value="{{$usuario->id}}">
              <input type="hidden" name="cantidad" value="1" min="1" max="10" class="form-control mb-2">
                                                                                                
              <button type="submit" class="btn btn-primary" width="">Añadir al carrito</button>
          </form>
        </td>
        @endif

     </tr>
     @endforeach
    </tr>
     @endforeach
  </tbody>

</table>
</div>
</div>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>