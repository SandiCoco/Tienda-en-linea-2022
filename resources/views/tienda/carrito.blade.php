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

<div class="container">
<h1 class="mt-3">Carrito de compras de {{$user->nombre}}</h1>
@if($user->nombre == 'Invitado')
<p class="text-danger">Podras hacer compras con nosotros, sin embargo no podras cancelar tu pedido sin antes haber iniciado sesion! </p>
<p>Tu pedido sera enviado a tu centro de paquetes mas cercano</p>
@else
<p>Nos alegra que compres con nosostros! Recuerda que tienes 5 minutos para poder cancelar tu orden sin recargos desde tu historial.</p>

@endif
@if($user->referido == true)
<p class="text-success">Al ser un usuario referido, gozas de $2 de descuento.</p>
@endif
@if($user->nuevo == true)
<p class="text-success">Al ser un usuario nuevo, gozas de 15% de descuento.</p>
@endif

<div class="container d-flex">
       
    <table class="table">
    <thead>
      <tr>
        <th scope="col">Producto</th>
        <th scope="col">Foto</th>
        <th scope="col">Nombre</th>
        <th scope="col">Precio</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Acciones</th>
        
      </tr>
    </thead>
    <tbody>


      <tr>
        @foreach ($producto as $pro)
          @foreach ($carrito as $car)
          <tr>
            @if($car->producto_id == $pro->id)
              <th scope="row">{{$pro->id}}</th>
              <td><img src="{{asset('storage').'/'.$pro->foto}}" alt="" width="100"></td>
              <td>{{$pro->nombre}}</td>
              <td>${{$pro->precio_venta}}</td>
              <td>{{$car->cantidad}} </td>
              <td>
              <form action="{{route('tienda.deleteCarrito', $car->id)}}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Eliminar</button>
              </form>
              </td>
              @php
              $array = [];
              array_push($array, $pro->id);
              @endphp
            @endif
          @endforeach
          </tr>
        @endforeach
        
      </tr>

      <tr>
        <th scope="row">Total</th>
        <td>
          @php
            $total = 0;
          @endphp

          @foreach($producto as $pro)
              @foreach($carrito as $car)
                @if($car->producto_id == $pro->id)
                  @php

                    $total = $total + ($pro->precio_venta*$car->cantidad);
                  @endphp
                @endif
              @endforeach
          @endforeach

          ${{$total}}
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tbody>

  </table>
</div>

@if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

<form action="{{ route('tienda.comprar') }}" method="POST">
  @csrf
  <input type="hidden" name="total" value="{{$total}}">
  <input type="hidden" name="usuario_id" value="{{$user->id}}">
  <div class="d-flex justify-content-start mt-3">
    <div class="card me-3" style="width: 16rem;">
    <div class="card-body ">
      <h5 class="card-title">¿Tienes un cupon?</h5>
      <h6 class="card-subtitle mb-2 text-muted">Introduce el codigo aqui.</h6>
      
      <input type="text" name="cupon" id="cupon" class="form-control">
    </div>
    </div>
    <div class="card" style="width: 21rem;">
    <div class="card-body">
      <h5 class="card-title">Especifica tu direccion de envio.</h5>
      <h6 class="card-subtitle mb-2 text-muted">Enviaremos tu paquete de 3 a 4 dias habiles.</h6>
      @if($user->nombre == 'Invitado')
        <label for="cupon">Direccion de envio:</label>
        <input type="text" name="direccion_envio" id="direccion_envio" class="form-control">
          @error('direccion_envio')
            <small class="text-danger">{{ $message }}</small>
              @enderror
          @else
          
        <input type="text" name="direccion_envio" id="dir" value="{{$user->direccion}}" class="form-control">
        @error('direccion_envio')
            <small class="text-danger">{{ $message }}</small>
              @enderror
      @endif
    </div>
    </div>
  </div>
  @foreach($producto as $pro)
    @foreach($carrito as $car)
      @if($car->producto_id == $pro->id)
        <input type="hidden" name="producto_id[]" value="{{$pro->id}}">
        <input type="hidden" name="cantidad[]" value="{{$car->cantidad}}">
      @endif
    @endforeach
  @endforeach
  <button type="submit" class="btn btn-success mt-3">¡Comprar!</button>
</form>
</div>


    

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>