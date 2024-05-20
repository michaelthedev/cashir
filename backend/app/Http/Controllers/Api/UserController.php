<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class UserController extends Controller
{
    public function get(): JsonResponse
    {
        return response()->json([
            'message' => 'user data',
            'data' => auth()->user()
        ]);
    }
}
