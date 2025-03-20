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
        <a href="{{route('usuario.create')}}"><button class="btn btn-primary btn-block me-2" >crear usuario</button></a>
        <a href="{{route('productos.create')}}"><button class="btn btn-primary btn-block me-2" >crear producto</button></a>
        <a href="{{route('admin.indexProductos')}}"><button class="btn btn-primary btn-block me-2" >administrar Productos</button></a>
    </div>

    <div class="container d-flex">
       
    <table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Foto</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Correo</th>
      <th scope="col">Rol</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($Users as $user)
    <tr>
        
      <th scope="row">{{$user->id}}</th>
      <td><img src="{{asset('storage').'/'.$user->foto}}" alt="" width="100"></td>
      <td>{{$user->nombre}}</td>
      <td>{{$user->apellido}}</td>
      <td>{{$user->correo}}</td>
      <td>{{$user->rol}}</td>
      <td>
        <a href="{{ route('admin.userEdit', $user->id) }}"><button class="btn btn-warning mb-2" style="width: 5.5rem;">Editar</button></a>

        @if($user->id != 1 && $user->id != 2 )

        <form action="{{ route('admin.Userdestroy', $user->id) }}" method="POST">
        @method('DELETE')
        @csrf
          <button class="btn btn-danger" style="width: 5.5rem;">Eliminar</button>
        </form>
        @else
        <br><br>
        @endif
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