<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\EquipmentCategoryResource;
use App\Http\Resources\EquipmentDocumentResource;

class EquipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => new EquipmentCategoryResource($this->category),
            'user_id' => $this->user_id,
            'brand' => $this->brand,
            'serial_number' => $this->serial_number,
            'buy_date' => $this->buy_date,
            'documents' => EquipmentDocumentResource::collection($this->documents),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
    
    public function withResponse($request, $response)
    {
        $response->setStatusCode(200, '');
    }
}
