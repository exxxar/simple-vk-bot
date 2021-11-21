<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "auditory_number",
        "teacher_full_name",
        "teacher_email",
        "faculty",
        "speciality",
        "department",
        "group",
        "course",
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "id" => "integer",
    ];


    public function classCallLists()
    {
        return $this->belongsToMany(\App\ClassCallList::class);
    }
}
