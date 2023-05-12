<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function generateResponse(int $status, array $data, string $message = ''): JsonResponse
    {
        if ($status === 200) {
            return response()->json([
                'status' => $status,
                'data' => current($data),
                'message' => $message,
            ], $status);
        } else {
            return response()->json([
                'status' => $status,
                'message' => !empty(json_decode($message)) ? json_decode($message) : $message,
            ], $status);
        }
    }
}
