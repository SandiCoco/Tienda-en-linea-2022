@csrf

<div class="form-group mt-3">
<label for="code">code</label>
<input class="form-control" id="code" type="text" name="code" value="{{old('code')}}">
@error('code')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="form-group mt-3">
<label for="fecha_inicio">fecha de inicio</label>
<input class="form-control" id="fecha_inicio" type="date" name="fecha_inicio" value="{{old('fecha_inicio')}}">
@error('fecha_inicio')
<small class="text-danger">{{ $message }}</small>
@enderror

</div>

<div class="form-group mt-3">
<label for="descuento">descuento (%) </label>
<input class="form-control" id="descuento" type="number" name="descuento" value="{{old('descuento')}}">
@error('descuento')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="form-group mt-3">
<label for="fecha_fin">fecha_fin</label>
<input class="form-control" id="fecha_fin" type="date" name="fecha_fin" value="{{old('fecha_fin')}}">
@error('fecha_fin')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<input type="submit" value="Guardar" class="form-control mt-5 bg-primary text-white">
