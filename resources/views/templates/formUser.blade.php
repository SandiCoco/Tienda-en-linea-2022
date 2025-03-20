
@csrf

    <div class="form-group mt-2">
        <label for="Nombre">Nombre</label>
        <input class="form-control" id="nombre" type="text" name="nombre" value="{{old('nombre')}}">
        @error('nombre')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group mt-2">
        <label for="apellido">Apellido</label>
        <input class="form-control" id="apellido" type="text" name="apellido" value="{{old('apellido')}}">
    </div>

    <div class="form-group mt-2">
        <label for="usuario">Usuario</label>
        <input class="form-control" id="usuario" type="text" name="usuario" value="{{old('usuario')}}">
        @error('usuario')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

<div class="form-group mt-2">
<label for="correo">Email</label>
<input class="form-control" id="correo" type="email" name="correo" value="{{old('correo')}}">

@error('correo')
    <small class="text-danger">{{ $message }}</small>
@enderror

</div>

<div class="form-group mt-2">
    <label for="password">Password</label>
    <input class="form-control" id="password" type="password" name="password">
    @error('password')
    <small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="form-group mt-2">
    <label for="pais">Pais</label>
    <input class="form-control" id="pais" type="text" name="pais" value="{{old('pais')}}">
</div>

<div class="form-group mt-2">
    <label for="direccion">Direccion</label>
    <input class="form-control" id="direccion" type="text" name="direccion" value="{{old('direccion')}}">
</div>

<div class="form-group mt-2">
    <label for="direccion_envio">Direccion de envio</label>
    <input class="form-control" id="direccion_envio" type="text" name="direccion_envio" value="{{old('direccion_envio')}}"> 
</div>

<div class="form-group mt-2">
    <label for="rol">Rol</label>
    <select class="form-control" name="rol" id="rol" class="form-select" aria-label="Default select example">
        <option value="Usuario">Usuario</option>
        <option value="Administrador">Administrador</option>
      </select>
      @error('rol')
    <small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="form-group mt-2">
    <label for="foto">Foto</label>
    <input class="form-control" id="foto" type="file" name="foto" accept="image/*">
    @error('foto')
    <small class="text-danger">{{ $message }}</small>
@enderror
</div>

<input class="form-control mt-5 bg-primary text-white" type="submit" value="Crear">

@if(session()->has('success'))
    <div class="form-control alert alert-success">
    {{ session()->get('success') }}
    </div>
@endif