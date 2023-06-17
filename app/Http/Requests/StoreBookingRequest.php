<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBookingRequest extends FormRequest
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
            'bookable_slot_id' => 'required',
            'people' => 'required|array',
            'people.*.email' => 'required|email',
            'people.*.first_name' => 'required',
            'people.*.last_name' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->getMessages();
        $errorsMessages = [];

        foreach ($errors as $error) {
            $errorsMessages[] = $error[0];
        }

        throw new HttpResponseException(response()->json([
            "code" => 406,
            "message" => $errorsMessages
        ], 406));
    }
}
