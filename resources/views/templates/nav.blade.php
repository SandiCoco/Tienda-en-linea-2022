@section('NavBar')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline ms-2"><button class="btn btn-dark btn-block">Log in</button></a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class=" text-sm text-gray-700 dark:text-gray-500 underline"><button class="btn btn-dark btn-block ms-1">Register</button></a>
                @endif

                <a href="{{ route('tienda.carrito', $user->id) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                    <button class="btn btn-success btn-block ms-1" >Carrito</button>
                </a>
        </div>

</nav>
@show