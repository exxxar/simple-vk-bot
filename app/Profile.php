<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'faculty',
        'speciality',
        'department',
        'group',
        'course',
        'vk_url',
        'true_first_name',
        'true_last_name',
        'student_id',
        'user_id',
        'blocked_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'blocked_at',
    ];


    public function user()
    {
        return $this->hasOne(\App\User::class);
    }

    public function student()
    {
        return $this->hasOne(\App\Student::class);
    }
}
