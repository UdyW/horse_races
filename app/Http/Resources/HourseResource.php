<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HourseResource extends JsonResource
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
            'id' => $this->horse_id,
            'name' => $this->name,
            'cloth' => $this->cloth_number
        ];
    }
}
