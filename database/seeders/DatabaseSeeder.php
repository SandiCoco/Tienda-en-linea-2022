<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'nombre' => 'Admin',
            'apellido' => 'Admin',
            'correo' => 'admin@admin.com',
            'usuario' => 'Admin',
            'password' =>   bcrypt('password+'),
            'edad' =>'20',
            'foto' =>fake()->imageUrl(640, 480, 'people'),
            'pais' =>fake()->country(),
            'direccion' =>fake()->address(),
            'direccion_envio' =>fake()->address(),
            'referido' =>'false',
            'rol' => 'Administrador',
        ]);

        DB::table('users')->insert([
            'nombre' => 'Invitado',
            'apellido' => 'Invitado',
            'correo' => 'correo@correo.com',
            'usuario' => 'Invitado',
            'password' =>   bcrypt('password+'),
            'edad' =>'20',
            'foto' =>fake()->imageUrl(640, 480, 'people'),
            'pais' =>fake()->country(),
            'direccion' =>fake()->address(),
            'direccion_envio' =>fake()->address(),
            'referido' =>'false',
            'rol' => 'Usuario',
        ]);

        DB::table('productos')->insert([
            'codigo' => '0001',
            'nombre' => 'Acrid Plushie',
            'descripcion' => 'Acid dog',
            'costo' => '30',
            'precio_venta' => '50',
            'foto' => 'imagenes/acrid.webp',
            'categoria' => 'juguetes',
            'stock' => '10',
            'proveedor' => 'Acrid',
        ]);

        DB::table('productos')->insert([
            'codigo' => '0002',
            'nombre' => 'Undertale: Collectors Edition',
            'descripcion' => 'Includes: Undertale, Deltarune, and Undertale Soundtrack',
            'costo' => '30',
            'precio_venta' => '60',
            'foto' => 'imagenes/undertale.webp',
            'categoria' => 'ediciones coleccionistas',
            'stock' => '10',
            'proveedor' => 'Toby Fox',
        ]);

        DB::table('productos')->insert([
            'codigo' => '0003',
            'nombre' => 'Risk of Rain 2: Nintendo Switch Physical Edition',
            'descripcion' => 'Includes: Risk of Rain 2, Risk of Rain 2 Soundtrack, and Risk of Rain 2 Artbook',
            'costo' => '30',
            'precio_venta' => '60',
            'foto' => 'imagenes/ror2switch.jpg',
            'categoria' => 'videojuegos',
            'stock' => '10',
            'proveedor' => 'Gearbox Publishing',
        ]);

        DB::table('productos')->insert([
            'codigo' => '0004',
            'nombre' => 'Devil May Cry 5: Special Edition',
            'descripcion' => 'Includes: Devil May Cry 5, Devil May Cry 5 Soundtrack, and Devil May Cry 5 Artbook',
            'costo' => '30',
            'precio_venta' => '60',
            'foto' => 'imagenes/dmcv.webp',
            'categoria' => 'ediciones coleccionistas',
            'stock' => '10',
            'proveedor' => 'Capcom',
        ]);

        DB::table('productos')->insert([
            'codigo' => '0005',
            'nombre' => 'Katana Zero',
            'descripcion' => 'Katana Zero is a stylish neo-noir, action-platformer featuring breakneck action and instant-death combat.',
            'costo' => '30',
            'precio_venta' => '15',
            'foto' => 'imagenes/katana.webp',
            'categoria' => 'videojuegos',
            'stock' => '10',
            'proveedor' => 'Devolver Digital',
        ]);

        DB::table('productos')->insert([
            'codigo' => '0006',
            'nombre' => 'The Binding of Isaac: Afterbirth+',
            'descripcion' => 'The Binding of Isaac: Afterbirth+ is the standalone expansion to The Binding of Isaac: Rebirth.',
            'costo' => '30',
            'precio_venta' => '15',
            'foto' => 'imagenes/isaac.webp',
            'categoria' => 'videojuegos',
            'stock' => '10',
            'proveedor' => 'Nicalis',
        ]);

        DB::table('productos')->insert([
            'codigo' => '0007',
            'nombre' => 'The Legend of Zelda: Breath of the Wild',
            'descripcion' => 'The Legend of Zelda: Breath of the Wild is an action-adventure game developed and published by Nintendo for the Nintendo Switch and Wii U video game consoles.',
            'costo' => '30',
            'precio_venta' => '60',
            'foto' => 'imagenes/zelda.webp',
            'categoria' => 'videojuegos',
            'stock' => '10',
            'proveedor' => 'Nintendo',
        ]);

        DB::table('productos')->insert([
            'codigo' => '0008',
            'nombre' => 'Guilty Gear: Strive for the PS4',
            'descripcion' => 'Guilty Gear: Strive is a 2D fighting game developed by Arc System Works and published by Arc System Works and Aksys Games.',
            'costo' => '30',
            'precio_venta' => '30',
            'foto' => 'imagenes/ggs.webp',
            'categoria' => 'videojuegos',
            'stock' => '10',
            'proveedor' => 'Arc System Works',
        ]);

        DB::table('productos')->insert([
            'codigo' => '0009',
            'nombre' => 'Metal Gear Rising: Revengeance for the PS3',
            'descripcion' => 'Metal Gear Rising: Revengeance is an action hack and slash video game developed by PlatinumGames and published by Konami for the PlayStation 3, Xbox 360, and Microsoft Windows.',
            'costo' => '30',
            'precio_venta' => '30',
            'foto' => 'imagenes/mgsr.webp',
            'categoria' => 'videojuegos',
            'stock' => '10',
            'proveedor' => 'Konami',
        ]);

        DB::table('productos')->insert([
            'codigo' => '0010',
            'nombre' => 'Ultimate Chicken Horse',
            'descripcion' => 'Ultimate Chicken Horse is a party platformer where you and your friends build absurd obstacle courses and try to beat them.',
            'costo' => '30',
            'precio_venta' => '15',
            'foto' => 'imagenes/uch.webp',
            'categoria' => 'videojuegos',
            'stock' => '10',
            'proveedor' => 'Team17',
        ]);

        DB::table('productos')->insert([
            'codigo' => '0011',
            'nombre' => 'Shovel Knight: Treasure Trove',
            'descripcion' => 'Shovel Knight: Treasure Trove is a 2014 action-adventure video game developed by Yacht Club Games and published by Yacht Club Games and Nintendo.',
            'costo' => '30',
            'precio_venta' => '25',
            'foto' => 'imagenes/sn.webp',
            'categoria' => 'videojuegos',
            'stock' => '10',
            'proveedor' => 'Yacht Club Games',
        ]);

        DB::table('productos')->insert([
            'codigo' => '0012',
            'nombre' => 'Hades for the PS4',
            'descripcion' => 'Hades is a roguelike action-adventure video game developed and published by Supergiant Games.',
            'costo' => '30',
            'precio_venta' => '25',
            'foto' => 'imagenes/hades.webp',
            'categoria' => 'videojuegos',
            'stock' => '10',
            'proveedor' => 'Supergiant Games',
        ]);


        $this->call([
            ProductoSeeder::class,
        ]);

    }
}
