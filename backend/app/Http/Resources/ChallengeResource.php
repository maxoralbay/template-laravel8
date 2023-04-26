<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ChallengeCategoryResource;
use App\Http\Resources\EquipmentCategoryResource;

class ChallengeResource extends JsonResource
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
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'content' => $this->content,
            'category' => new ChallengeCategoryResource($this->category),
            'equipment_category' => new EquipmentCategoryResource($this->equipmentCategory),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
    
    public function withResponse($request, $response)
    {
        $response->setStatusCode(200, '');
    }
}
