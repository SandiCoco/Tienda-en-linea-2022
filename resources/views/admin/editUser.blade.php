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

<!-- EDITAR USUARIO DESDE ADMIN -->
    <nav>
        <a href="{{route('adminUser.index')}}"><button class="btn btn-primary btn-block ms-2 mt-2">Regresar</button></a>
    </nav>


    <div class="container d-flex justify-content-center mt-3" >
        <div class="card" style="width: 30rem;">
            <div class="card-body">
                <form action="{{route('admin.userUpdate', $User->id)}}" method="POST" enctype="multipart/form-data" onsubmit="return checkPassword()" >
                    @method('PUT')
                        <div>
                            <h1>Datos de usuario</h1>
                        </div>
                    @csrf
                        <div class="card-image-top">
                        <img src="{{asset('storage').'/'.$User->foto}}" height="100" width="auto">
                        </div>

                        <div class="form-group mt-2">
                        <label for="nombre">Nombre</label>
                        <input class="form-control" type="text" name="nombre" id="nombre" value="{{$User->nombre}}">
                        </div>

                        <div class="form-group mt-2">
                        <label for="apellido">Apellido</label>
                        <input class="form-control" type="text" name="apellido" id="apellido" value="{{$User->apellido ?? old('apellido') }}">
                        </div>

                        <div class="form-group mt-2">
                        <label for="correo">Correo</label>
                        <input class="form-control" type="email" name="correo" id="correo" value="{{$User->correo}}">
                        </div>

                        <div class="form-group mt-2">
                        <label for="usuario">Usuario</label>
                        <input class="form-control" type="text" name="usuario" id="usuario" value="{{$User->usuario}}">
                        </div>

                        <div class="form-group mt-2">
                        <label for="password">password</label>
                        <input class="form-control" type="password" name="password" id="password" value="{{$User->password}}">
                        </div>

                        <div class="form-group mt-2">
                        <label for="pais">País</label>
                        <input class="form-control" type="text" name="pais" id="pais" value="{{$User->pais}}">
                        </div>

                        <div class="form-group mt-2">
                        <label for="direccion">Dirección</label>
                        <input class="form-control" type="text" name="direccion" id="direccion" value="{{$User->direccion}}">
                        </div>

                        <div class="form-group mt-2">
                            <label for="direccion_envio">Dirección de envío</label>
                                <input class="form-control" type="text" name="direccion_envio" id="direccion_envio" value="{{$User->direccion_envio}}">
                            @error('direccion_envio')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="rol">Rol</label>
                                <select name="rol" id="rol" class="form-select" aria-label="Default select example">
                                    <option value="{{$User->rol}}">{{$User->rol}}</option>
                                    @if ($User->rol == 'Administrador')
                                        <option value="Usuario">Usuario</option>
                                    @else
                                        <option value="Administrador">Administrador</option>
                                    @endif
                                </select>
                            @error('rol')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                        <label for="foto">Foto</label>
                        <input class="form-control" type="file" name="foto" accept="image/*" id="foto" value="{{$User->foto}}">
                        </div>
   
                        <input type="submit" value="Guardar" class="form-control mt-5 bg-primary text-white">


                        <div class="container ">
            
                        @if(session()->has('success'))
                            <div class="form-control alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                    </form> 
            </div>
        </div>
    </div>

 <!-- JavaScript Bundle with Popper -->
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