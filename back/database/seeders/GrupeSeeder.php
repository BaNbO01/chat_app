<?php

namespace Database\Seeders;
use App\Models\Grupa;
use App\Models\User;
use Illuminate\Database\Seeder;

class GrupeSeeder extends Seeder
{
   
    public function run(): void
    {
        $grupe = Grupa::factory()->count(5)->create();

        foreach ($grupe as $grupa) {
            $korisnici = User::inRandomOrder()->take(rand(2, 5))->pluck('id');
            $grupa->korisnici()->attach($korisnici);
        }
    }
}

