<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return [
        //     'id' => $this->id,
        //     'name' => $this->name,
        //     'qr_code' => $this->qr_code,
        //     'created_at' => $this->created_at->format('d/m/Y'),
        //     'updated_at' => $this->updated_at->format('d/m/Y'),
        // ];
        return parent::toArray($request);
    }
}
