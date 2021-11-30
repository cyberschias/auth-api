<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $message
     * @param mixed  $data
     *
     * @return array
     */
    public static function createResponse(string $message, $data = []): array
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if (!empty($data)) {
            if(array_key_exists('data', $data)){
                $response = array_merge($response, $data);
            } else {
                $response['data'] = $data;
            }
        }

        return $response;
    }

    /**
     * @param string $message
     * @param array $data
     *
     * @return array
     */
    public static function createError(string $message, array $data = []): array
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return $response;
    }

    public function sendResponse($result, $message = 'Action successfully processed', $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json($this->createResponse($message, $result), $code);
    }

    public function sendError($message, $data = [], $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json($this->createError($message, $data), $code);
    }

    public function validationError($message = 'Validation error', $data = [], $code = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return response()->json($this->createError($message, $data), $code);
    }

    public function unauthorizedError(): JsonResponse
    {
        return response()->json($this->createError(__('auth.failed')), Response::HTTP_UNAUTHORIZED);
    }

}
