<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClientEditRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }

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
            'name' => 'required|alpha|string|max:45',
            'lastname' => 'required|alpha|string|max:45',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('clients')->ignore($this->query('id'))
            ]
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */ 
    public function messages()
    {
        return [
            'required' => 'The :attribute is required.',
            'max' => 'The :attribute must not exceed :max characters.',
            'unique' => 'The choosen :attribute is already registered. Please choose a new one.'
        ];
    }
}
