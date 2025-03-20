<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>Resgiter</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light" >
        <a href="{{route('tienda.index')}}"><button  class="btn btn-primary btn-block ms-2">Regresar</button></a>
</nav>
    
<div class="container d-flex justify-content-center mt-5">
<div class="card">
    <div class="card-body">
    <form action="{{route('registerReferred.store')}}" method="POST" class="" onsubmit="return checkPassword()">
        @csrf
        <h2>Registrese!</h2>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="{{old('nombre')}}" id="nombre" class="form-control">
            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" name="correo" value="{{old('correo')}}" id="correo" class="form-control">
            @error('correo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" value="{{old('usuario')}} "id="usuario" class="form-control">
            @error('usuario')
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

        <input type="submit" value="Registrar" class="btn btn-primary me-2" id="enviar">

        <a href="{{route('login')}}">Iniciar Sesion</a>
    </form>
    </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script>    
        function checkPassword() {  //Funcion validar contraseña

            var password = document.getElementById("password").value;   //Obtener valor de contraseña

            if (password.length < "8") {    //Validar contraseña

                document.getElementById("password").style.border = "1px solid red";    //Cambiar color de contraseña
                alert("La contraseña debe ser de al menos 8 caracteres como minimo");   //Mostrar mensaje de error
                document.getElementById("password").value = "";    //Limpiar contraseña
                return false
            } else if (password.indexOf(" ") > -1) {    //Validar contraseña
                alert("La contraseña no puede contener espacios");  //Mostrar mensaje de error
                document.getElementById("password").value = "";    //Limpiar contraseña
                return false;
            } else if (!password.includes("+") && !password.includes("*") && !password.includes(".")) {   //Validar contraseña
                alert("La contraseña debe incluir +,* o .")
                return false
            }
        }
    </script>
</body>
</html>