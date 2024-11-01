<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupa extends Model
{
    use HasFactory;
    protected $table = 'grupe';


    protected $fillable = ['naziv', 'ikonica', 'opis'];

    public function korisnici() {
        return $this->belongsToMany(User::class, 'grupa_korisnik');
    }

    public function poruke() {
        return $this->hasMany(Poruka::class);
    }
}
