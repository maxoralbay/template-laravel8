<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentCategoryResource extends JsonResource
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
            'image' => asset($this->image),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
    
    public function withResponse($request, $response)
    {
        $response->setStatusCode(200, '');
    }
}
