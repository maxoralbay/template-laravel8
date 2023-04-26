<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class IncorrectCredentialsResource extends JsonResource
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
            'status' => false,
            'message' => 'Incorrect login or password!'
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(401, 'Unauthenticated!');
    }
}
