<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poruka extends Model
{
    use HasFactory;

    protected $table = 'poruke';

    protected $casts = [
        'vreme_slanja' => 'datetime', // Ovo će omogućiti da se vreme_slanja automatski konvertuje u Carbon instancu
    ];

    protected $fillable = ['posiljalac_id', 'primalac_id', 'grupa_id', 'sadrzaj', 'tip', 'vreme_slanja'];

    public function posiljalac() {
        return $this->belongsTo(User::class, 'posiljalac_id');
    }

    public function primalac() {
        return $this->belongsTo(User::class, 'primalac_id');
    }

    public function grupa() {
        return $this->belongsTo(Grupa::class);
    }
}
