<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'codigo' => fake()->unique()->randomNumber(8),
            'nombre' => fake()->Name(),
            'descripcion' => fake()->text(),
            'costo' => fake()->numberBetween(100, 1000),
            'precio_venta' => fake()->numberBetween(100, 1200),
            'stock' => fake()->numberBetween(1, 100),
            'foto' => fake()->imageUrl(),
            'categoria' => fake()->randomElement(['ropa', 'zapatos', 'accesorios', 'electrodomesticos']),
            'proveedor' => fake()->company(),
        ];
    }
}
