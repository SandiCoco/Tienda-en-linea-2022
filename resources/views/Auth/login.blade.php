<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>Iniciar sesion</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light" >
        <a href="{{route('tienda.index')}}"><button  class="btn btn-primary btn-block ms-2">Regresar</button></a>
    </nav>

    <div class="container d-flex justify-content-center mt-5">
    
    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <form action="{{route('login.verify')}}" method="POST" class="">
                @csrf
                <div class="card-title">
                <h2>Iniciar sesion</h2>
                </div>

                @error('Invalid_credentials')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror

            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" name="correo" value="{{old('correo')}}" id="correo" class="form-control">
                @error('correo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <input type="submit" value="Iniciar Sesion" class="btn btn-primary me-2">

            <a href="{{route('register')}}">Registrarse</a>
        </form>
    </div>
    </div>
    </div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>