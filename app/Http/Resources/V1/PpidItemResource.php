<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PpidItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'file_url' => $this->file ? '/storage/' . $this->file : null,
            'tanggal_pembuatan' => $this->tanggal_pembuatan,
            'views' => $this->views,
            'downloads' => $this->downloads,
        ];
    }
}
