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

    <div class="container">
        <a href="{{route('tienda.cuponcreate')}}"><button class="btn btn-primary btn-block mt-3"> crear cupon</button></a>
    </div>

    <div class="container d-flex">
       
    <table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">codigo</th>
      <th scope="col">Fecha de inicio</th>
      <th scope="col">Fecha de finalizacion</th>
      <th scope="col">Descuento (%)</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($cupons as $cupon)
    <tr>
        
      <th scope="row">{{$cupon->id}}</th>
      <td>{{$cupon->code}}</td>
      <td>{{$cupon->fecha_inicio}}</td>
      <td>{{$cupon->fecha_fin}}</td>
      <td>{{$cupon->descuento}}</td>
      <td>
        <form action="{{ route('tienda.cupondestroy', $cupon->id) }}" method="POST">
        @method('DELETE')
        @csrf
          <input  class="btn btn-danger" type="submit" value="Eliminar">
        </form>
    </td>
     
    </tr>
     @endforeach
  </tbody>
</table>

</div>

<div class="container ">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>