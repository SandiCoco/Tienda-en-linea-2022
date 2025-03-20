<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre' => 'Test User',
            'apellido' => 'Test User',
            'correo' => 'admin@admin.com',
            'usuario' => 'pepe',
            'password' =>   bcrypt('password+'),
            'edad' =>'20',
            'foto' =>fake()->imageUrl(640, 480, 'people'),
            'pais' =>fake()->country(),
            'direccion' =>fake()->address(),
            'direccion_envio' =>fake()->address(),
            'referido' =>fake()->boolean(),
            'rol' => 'Administrador',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
