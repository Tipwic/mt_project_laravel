<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Guild extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'bannier_url' => asset(  "/upload/".$this->bannier_url),
            'desc' => $this->articles,
            'grades' => $this->grades,
            'games' => $this->games
        ];
    }
}
