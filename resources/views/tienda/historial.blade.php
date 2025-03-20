<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>Historial</title>
</head>
<body>

<nav>
  <a href="{{route('tienda.Auth')}}"><button class="btn btn-primary btn-block ms-2 mt-2">Regresar</button></a>
</nav>
<div class="container">
<h1 class="mt-2">Historial de compras</h1>
    
<div class="container">
  <table class="table mt-4">
    <thead>
      <tr>
        <th scope="col">Producto</th>
        <th scope="col">Total pagado</th>
        <th scope="col">Fecha de compra</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>

    @foreach ($historial as $hist)
    <tr>
        
      <th scope="row">{{$hist->id}}</th>
      <td>{{$hist->total}}</td>
      <td>{{$hist->created_at}}</td>
      <td>
        @php
        $date = date('Y/m/d h:i:s a', time()); 
        $secs = strtotime($date) - strtotime($hist->created_at);
        $minutes = $secs / 60;
        @endphp
        @if($minutes<=5)
        <form action="{{route('tienda.destroyHistorial', $hist->id)}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Cancelar</button>
        @endif  
      </td>
     
    </tr>
     @endforeach
    </tbody>

  </table>
</div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>