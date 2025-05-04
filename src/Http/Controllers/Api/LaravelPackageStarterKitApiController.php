<?php

namespace LaravelPackageStarterKit\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LaravelPackageStarterKitApiController extends Controller
{
    /**
     * Return API data list.
     * API veri listesini döndür.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'message' => 'Package API Response',
            'status' => 'success',
            'data' => []
        ]);
    }
} 