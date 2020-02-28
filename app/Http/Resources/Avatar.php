<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Avatar extends JsonResource
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
                'user_id' => $this->user_id,
                'name' => $this->name,
                'portrait_url' => asset(  "/upload/".$this->portrait_url),
                'img' => $this->getgetFile,
                'nick_name' => $this->nick_name,
                'guild' => $this->guild,
                'grade' => $this->grade,
                'game' => $this->game

        ];
    }

}
