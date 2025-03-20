@section('NavBar')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    @if (Route::has('login'))

            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                <div class="container d-flex">
                <form method="POST" action="{{route('logout')}}">
                @csrf
                <button type="submit" class="btn btn-danger btn-block me-2">Cerrar Sesion</button> 
                </form>
                <a href="{{ route('tienda.editUser', $User->id) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                    <button class="btn btn-dark btn-block me-2" >Perfil</button>
                </a>

                @if($User->rol == 'Administrador')
                <a href="{{ route('adminUser.index') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                <button class="btn btn-dark btn-block me-2" >Administrador</button>
                </a>
                <a href="{{ route('tienda.cupon') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                <button class="btn btn-dark btn-block me-2" >Cupons</button>
                </a>
                @endif

                <a href="{{ route('tienda.wish', $User->id) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                    <button class="btn btn-dark btn-block me-2" >Wishlist</button>
                </a>

                <a href="{{ route('tienda.historial', $User->id) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                    <button class="btn btn-dark btn-block me-2" >Historial</button>
                </a>

                <a href="{{ route('tienda.carrito', $User->id) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                    <button class="btn btn-success btn-block me-2" >Carrito</button>
                </a>
                
                </div>
                @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif

            @endauth

        </div>
    @endif
</nav>
@show