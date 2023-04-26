<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\ChallengeResource;

class LoginResource extends JsonResource
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
            'status' => true,
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'image' => asset($this->image),
            'zipcode' => $this->zipcode,
            'garanty' => $this->garanty,
            'access_token' => $this->createToken('access_token')->plainTextToken,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'role' => new RoleResource($this->role),
            'completed_challenges' => ChallengeResource::collection($this->completedChallenges),
        ];
    }
}
