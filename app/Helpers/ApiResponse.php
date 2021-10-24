<?php

namespace App\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ApiResponse{
    /**
     * @param null $message
     * @param null $data
     * @param int $code
     * @param null $errors
     * @param null $token
     * @return JsonResponse
     */
    public static function format(
        $status=true,
        $message = null,
        $data = null,
        int $code = 200,
        $errors = null,
        $token = null
    ): JsonResponse
    {
        $response = [
            'status'=>$status,
            'message' => $message,
            'errors' => $errors,
            'data' => $data
        ];

        if ($token) $response = array_merge($response, ['token' => $token]);

        return response()->json($response, $code);
    }

    /**
     * This function apiResponseValidation for Validation Request
     * @param $validator
     */
    public static function apiFormatValidation($validator)
    {
        $errors = $validator->errors();
        $response = self::format(false,'Invalid data send', null, 422, $errors->messages());
        throw new HttpResponseException($response);
    }
}