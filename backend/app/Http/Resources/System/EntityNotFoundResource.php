<?php

namespace App\Http\Resources\System;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityNotFoundResource extends JsonResource
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
            'message' => 'Entity not found!'
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(404, 'Entity not found!');
    }
}
