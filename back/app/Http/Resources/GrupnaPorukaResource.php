<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GrupnaPorukaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'posiljalac' => [
                'id' => $this->posiljalac_id,
                'username' => $this->posiljalac->username,
                'ikonica' => $this->posiljalac->icon,
            ],
            'sadrzaj' => $this->sadrzaj,
            'vreme_slanja' => $this->vreme_slanja->format('Y-m-d H:i:s'), // Možete prilagoditi format
        ];
    }
}

