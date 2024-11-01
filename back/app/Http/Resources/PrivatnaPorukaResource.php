<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivatnaPorukaResource extends JsonResource
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
            'primalac' => [
                'id' => $this->primalac_id,
                'username' => $this->primalac->username,
                'ikonica' => $this->primalac->icon,
            ],
            'sadrzaj' => $this->sadrzaj,
            'vreme_slanja' =>$this->vreme_slanja->toIso8601String(),
        ];
    }
}


