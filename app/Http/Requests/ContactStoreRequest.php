<?php

namespace App\Http\Requests;

use App\Rules\UniqueUserContacts;
use App\Exceptions\GlobalValidationTrait;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class ContactStoreRequest extends FormRequest
{
    use GlobalValidationTrait;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'  => 'required|regex:/^[A-Za-z\s\-]+$/',
            'phone' => ['required', 'numeric', 'digits_between:10,15', new UniqueUserContacts]
        ];
    }
}
