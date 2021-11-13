<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileStoreRequest extends FormRequest
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
            'first_name' => ['string'],
            'last_name' => ['string'],
            'faculty' => ['required', 'integer'],
            'speciality' => ['required', 'integer'],
            'department' => ['required', 'integer'],
            'group' => ['required', 'integer'],
            'course' => ['required', 'integer'],
            'vk_url' => ['string', 'max:1000'],
            'true_first_name' => ['string'],
            'true_last_name' => ['string'],
            'student_id' => ['integer'],
            'user_id' => ['required', 'integer'],
            'blocked_at' => [''],
        ];
    }
}
