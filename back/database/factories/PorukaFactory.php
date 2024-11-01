<?php

namespace Database\Factories;
use App\Models\Poruka;
use App\Models\User;
use App\Models\Grupa;
use Illuminate\Database\Eloquent\Factories\Factory;

class PorukaFactory extends Factory
{
    protected $model = Poruka::class;

    public function definition()
    {
        $isGroupChat = $this->faker->boolean(30); 

        if ($isGroupChat) {
       
            $grupa = Grupa::has('korisnici')->inRandomOrder()->first();
            return [
                'posiljalac_id' => $grupa->korisnici()->inRandomOrder()->first()->id, 
                'primalac_id' => null,
                'grupa_id' => $grupa->id,
                'sadrzaj' => $this->faker->sentence,
                'tip' => $this->faker->randomElement(['tekst', 'slika', 'audio']),
                'vreme_slanja' => $this->faker->dateTimeBetween('-1 years', 'now'),
            ];
        } else {
       
            return [
                'posiljalac_id' => User::inRandomOrder()->first()->id,
                'primalac_id' => User::inRandomOrder()->first()->id,
                'grupa_id' => null,
                'sadrzaj' => $this->faker->sentence,
                'tip' => $this->faker->randomElement(['tekst', 'slika', 'audio']),
                'vreme_slanja' => $this->faker->dateTimeBetween('-1 years', 'now'),
            ];
        }
    }
}
