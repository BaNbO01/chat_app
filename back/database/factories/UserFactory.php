<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'username' => $this->faker->userName,
            'password' => bcrypt('lozinka123'), 
            'role' => $this->faker->randomElement(['user', 'admin']),
            'icon' => $this->faker->imageUrl(100, 100, 'people'),
        ];
    }
}