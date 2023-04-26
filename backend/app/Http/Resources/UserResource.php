<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\ChallengeResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'image' => asset($this->image),
            'zipcode' => $this->zipcode,
            'garanty' => $this->garanty,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'role' => new RoleResource($this->role),
            'completed_challenges' => ChallengeResource::collection($this->completedChallenges),
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(200, '');
    }
}
