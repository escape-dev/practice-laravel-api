<?php
namespace App\Exceptions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

trait GlobalValidationTrait
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => $validator->errors(),
                'data' => null
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}