<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'faculty' => $this->faculty,
            'speciality' => $this->speciality,
            'department' => $this->department,
            'group' => $this->group,
            'course' => $this->course,
            'vk_url' => $this->vk_url,
            'true_first_name' => $this->true_first_name,
            'true_last_name' => $this->true_last_name,
            'student_id' => $this->student_id,
            'user_id' => $this->user_id,
            'blocked_at' => $this->blocked_at,
            'student' => StudentResource::make($this->whenLoaded('student')),
        ];
    }
}
