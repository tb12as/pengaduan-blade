<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PetugasUpdateRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:50',
                'min:4',
                Rule::unique('users', 'username')->ignore($request->user_id),
            ],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($request->user_id),],
            'password' => ['nullable', 'string', 'min:8', 'confirmed']
        ];
    }
}
