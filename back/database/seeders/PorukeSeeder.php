<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poruka;


class PorukeSeeder extends Seeder
{
  
    public function run(): void
    {
        Poruka::factory()->count(30)->create();
    }
}
