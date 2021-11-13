<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassCallList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'index',
        'start_at',
        'end_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function lessons()
    {
        return $this->belongsToMany(\App\Lesson::class);
    }
}
