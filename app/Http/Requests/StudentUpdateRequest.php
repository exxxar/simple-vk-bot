<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'faculty' => ['required', 'integer'],
            'speciality' => ['required', 'integer'],
            'department' => ['required', 'integer'],
            'group' => ['required', 'integer'],
            'course' => ['required', 'integer'],
        ];
    }
}
