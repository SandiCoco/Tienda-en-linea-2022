<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\HistorialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CuponController;
use App\Models\Producto;
use App\Models\User;


/*
Angel Diego Hidalgo Cartagena HC18040
Diego Paolo Morales Lopez ML20011
Edwin Daniel Lizama Garcia LG20012
Edwin Eismaeli Barrera Arce BA20010

dependecias: 
nodejs v18.12.1
utilizamos vite para la parte de css y javascript, para que funcione la primera vez que se ejecuta se tiene que borrar la carpeta
node_modules y ejecutar el comando npm install

luego se tiene que ejecutar los siguientes comandos:
php artisan storage:link 
php artisan migrate:fresh --seed
php artisan serve

y en otra terminal ejecutar el comando:
npm run dev

los datos de la base de datos son los siguientes: 
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=final
DB_USERNAME=postgres
DB_PASSWORD=123
*/


Route::get('/', function () {
    $productos = Producto::all();
    $user = User::where('id','2')->first();
    return view('tienda.tienda')->with('productos', $productos)->with('user', $user);
});

Route::controller(ProductoController::class)->group(function(){
    Route::get('/productos', 'index')->name('productos.index');//Muestra los productos en JSON
    Route::get('/productos/{producto}', 'show')->name('productos.show');//Muestra un producto en JSON
    Route::post('/productos', 'store')->name('productos.store');//Crea un producto en JSON
    Route::get('/create', 'create')->name('productos.create');//Muestra el formulario para crear un producto
});

Route::controller(AuthController::class)->group(function(){

    Route::get('/login', [AuthController::class, 'login'])->name('login');//Muestra el formulario de login
    Route::post('/login', [AuthController::class, 'loginVerify'])->name('login.verify');//Verifica el login

    Route::get('/register', [AuthController::class, 'register'])->name('register');//Muestra el formulario de registro
    Route::post('/register', [AuthController::class, 'registerVerify'])->name('register.store');//Crea el usuario

    Route::post('/registerReferred', [AuthController::class, 'registerReferredVerify'])->name('registerReferred.store');//Crea el usuario

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');//Cierra la sesión

    Route::get('/register/referred', [AuthController::class, 'registerReferred'])->name('register.referred');//Muestra el formulario de registro con referido
});

Route::controller(TiendaController::class)->group(function(){

    Route::get('/tiendaa', 'index')->name('tienda.index');//Muestra la tienda con o sin usuario resgistrado
    Route::get('/tienda/{producto}', 'showProducto')->name('tienda.showProducto');//Muestra un producto en la tienda

    Route::controller(UsuarioController::class)->group(function(){
        Route::get('/usuarios', 'index')->name('usuario.index');//Muestra los usuarios en JSON
        Route::get('/usuarios/{usuario}', 'show')->name('usuario.show');//Muestra un usuario en JSON
        Route::post('/usuarios', 'store')->name('usuario.store');//Crea un usuario en JSON
    });

    Route::controller(ProductoController::class)->group(function(){
        Route::get('/productos', 'index')->name('productos.index');//Muestra los productos en JSON
        Route::get('/productos/{producto}', 'show')->name('productos.show');//Muestra un producto en JSON
        Route::post('/productos', 'store')->name('productos.store');//Crea un producto en JSON
    });

    Route::post('/buscar', 'buscar')->name('tienda.buscar');//Busca un producto en la tienda

    Route::get('/tienda/user/{user}/carrito', [CarritoController::class, 'index'])->name('tienda.carrito');//Muestra el carrito del usuario
    Route::post('/tienda/user/carrito/add', [CarritoController::class, 'store'])->name('tienda.addCarrito');//Añade un producto al carrito
    Route::delete('/tienda/carrito/{producto}', [CarritoController::class, 'destroy'])->name('tienda.deleteCarrito');//Elimina un producto del carrito del usuario
    Route::post('/tienda/carrito', [CarritoController::class, 'comprar'])->name('tienda.comprar');//Realiza la compra de los productos del carrito del usuario

    Route::get('/tienda/user/{user}/resumen', [CarritoController::class, 'resumen'])->name('tienda.resumen');//Muestra la compra realizada
        
        
    Route::middleware('auth')->group(function()
    {
        Route::get('/tienda', 'indexAuth')->name('tienda.Auth');//Muestra la tienda con usuario resgistrado
        Route::get('/tienda/user/{user}', 'edit')->name('tienda.editUser');//Muestra el formulario para editar el usuario

        Route::post('/tienda/user/{user}', 'update')->name('tienda.updateUser');//Actualiza el usuario
        
        Route::get('/tienda/user/{user}/historial', 'historial')->name('tienda.historial');//Muestra el historial de compras del usuario
        Route::delete('/tienda/historial/{historial}', 'destroyHistorial')->name('tienda.destroyHistorial');//Elimina un historial de compras del usuario
        Route::get('/tienda/user/{user}/wish', 'wish')->name('tienda.wish');//Muestra la lista de deseos del usuario

        Route::post('/tienda/wish', 'addWish')->name('tienda.addWish');//Añade un producto a la lista de deseos del usuario
        Route::delete('/tienda/wish/{producto}', 'deleteWish')->name('tienda.deleteWish');//Elimina un producto de la lista de deseos del usuario

        Route::get('/cupon', [TiendaController::class, 'cupon'])->name('tienda.cupon');
        Route::get('/cupon/create', [TiendaController::class, 'cuponCreate'])->name('tienda.cuponcreate');
        Route::post('/cupon/create', [CuponController::class, 'store'])->name('tienda.cuponstore');
        Route::delete('/cupon/{cupon}', [CuponController::class, 'destroy'])->name('tienda.cupondestroy');


            Route::controller(AdminController::class)->group(function()
            {
                Route::get('/adminUser', 'index')->name('admin.index');//Muestra el panel de administración de usuarios
                Route::get('/adminUser/{user}/edit', 'edit')->name('admin.userEdit');//Muestra el formulario para editar el usuario
                Route::post('/adminUser/{user}/edit', 'update')->name('admin.userUpdate');//Actualiza el usuario
                Route::resource('adminUser', AdminController::class);
                Route::put('adminUser/{user}/edit', [AdminController::class, 'update'])->name('admin.userUpdate');//Actualiza el usuario
                Route::get('/crear', [UsuarioController::class, 'create'])->name('usuario.create');//Muestra el formulario para crear un usuario
                Route::delete('/adminUser/{user}', [AdminController::class, 'destroy'])->name('admin.Userdestroy');//Elimina el usuario
            });

            Route::controller(ProductoController::class)->group(function()
            {
                Route::get('/adminProductos', 'indexProductos')->name('admin.indexProductos');//Muestra el panel de administración de productos
                Route::get('/adminProductos/{producto}/edit', 'edit')->name('admin.productoEdit');//Muestra el formulario para editar el producto
                Route::put('/adminProductos/{producto}/edit', 'update')->name('admin.productoUpdate');//Actualiza el producto
                Route::resource('admin', ProductoController::class);
                Route::delete('adminProductos/{producto}', [ProductoController::class, 'destroy'])->name('admin.destroy');//Elimina el producto
                Route::get('/create', 'create')->name('productos.create');//Muestra el formulario para crear un producto

            });
        
    });

});


