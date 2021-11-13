<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'auditory_number' => $this->auditory_number,
            'teacher_full_name' => $this->teacher_full_name,
            'teacher_email' => $this->teacher_email,
            'faculty' => $this->faculty,
            'speciality' => $this->speciality,
            'department' => $this->department,
            'group' => $this->group,
            'course' => $this->course,
            'classCallLists' => ClassCallListCollection::make($this->whenLoaded('classCallLists')),
        ];
    }
}
