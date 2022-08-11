<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InfluencerResource extends JsonResource
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
            'username' => $this->username,
            'tier' => $this->tier,
            'category' => $this->category,
            'urlpict' => $this->urlpict,
            'verfied' => $this->verfied,
            'followers' => $this->followers,
            'engagement' => $this->engagement,
            'contact' => $this->contact,
            'ratecard' => $this->ratecard,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}