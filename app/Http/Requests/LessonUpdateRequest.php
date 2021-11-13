<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'auditory_number' => ['required', 'string'],
            'teacher_full_name' => ['required', 'string'],
            'teacher_email' => ['required', 'string'],
            'faculty' => ['required', 'integer'],
            'speciality' => ['required', 'integer'],
            'department' => ['required', 'integer'],
            'group' => ['required', 'integer'],
            'course' => ['required', 'integer'],
        ];
    }
}
