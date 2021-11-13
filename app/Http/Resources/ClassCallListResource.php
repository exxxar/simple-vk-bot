<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassCallListResource extends JsonResource
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
            'title' => $this->title,
            'index' => $this->index,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'lessons' => LessonCollection::make($this->whenLoaded('lessons')),
        ];
    }
}
