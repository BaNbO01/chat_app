<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Grupa;


class GrupaFactory extends Factory
{
    protected $model = Grupa::class;

    public function definition()
    {
        return [
            'naziv' => $this->faker->company,
            'ikonica' => $this->faker->imageUrl(100, 100, 'business'),
            'opis' => $this->faker->sentence(10),
        ];
    }
}
