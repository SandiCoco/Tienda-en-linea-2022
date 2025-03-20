

@csrf

<div class="form-group mt-2">
<label for="codigo">codigo</label>
<input class="form-control" id="codigo" type="text" name="codigo" value="{{old('codigo')}}">
@error('codigo')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="form-group mt-2">
<label for="name">Nombre</label>
<input class="form-control" id="nombre" type="text" name="nombre" value="{{old('nombre')}}">
@error('nombre')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="form-group mt-2">
<label for="costo">Costo</label>
<input class="form-control" id="costo" type="text" name="costo" value="{{old('costo')}}">
@error('costo')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="form-group mt-2">
<label for="price">Precio de venta</label>
<input class="form-control" id="precio_venta" type="text" name="precio_venta" value="{{old('precio_venta')}}">
@error('precio_venta')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="form-group mt-2">
<label for="stock">stock</label>
<input class="form-control" id="stock" type="text" name="stock" value="{{old('stock')}}">
@error('stock')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="form-group mt-2">
<label for="description">description</label>
<input class="form-control" id="description" type="text" name="descripcion" value="{{old('descripcion')}}">
@error('descripcion')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="form-group mt-2">
<label for="categoria">categoria</label>
<input class="form-control" id="categoria" type="text" name="categoria" value="{{old('categoria')}}">
@error('categoria')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="form-group mt-2">
<label for="proveedor">proveedor</label>
<input class="form-control" id="proveedor" type="text" name="proveedor" value="{{old('proveedor')}}">
@error('proveedor')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="form-group mt-2">
<label for="foto">Imagen</label>
<input class="form-control" id="foto" type="file" accept="image/*" name="foto" value="{{old('foto')}}">
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