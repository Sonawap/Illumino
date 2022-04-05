<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class BookingRequest extends FormRequest
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

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors()->getMessages(), 422));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rider_name' => 'required|string',
            'rider_destination' => 'required|string',
            'rider_location' => 'required|string'
        ];
    }
    
    public function message()
    {
        return [
            'rider_name.required' => 'Rider Name is required',
            'rider_destination.required' => 'Rider Destination is required',
            'rider_location.required' => 'Rider Location is required',
        ];
    }
}
