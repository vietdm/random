<?php

namespace App\Response;

use Illuminate\Http\JsonResponse;

class Response {
    public static function success($data, $mgs = 'Success!'): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $mgs,
            'data' => $data
        ]);
    }

    public static function error($mgs, $data = []): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $mgs,
            'data' => $data
        ]);
    }
}
