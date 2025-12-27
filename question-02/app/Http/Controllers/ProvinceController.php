<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ProvinceController extends Controller
{
    /**
     * Display a listing of provinces.
     * GET /api/provinsi
     */
    public function index(): JsonResponse
    {
        $provinces = Province::all();

        return response()->json([
            'success' => true,
            'message' => 'List of provinces',
            'data' => $provinces,
        ], 200);
    }

    /**
     * Store a newly created province.
     * POST /api/provinsi
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'code' => 'required|string|max:10|unique:provinces,code',
                'name' => 'required|string|max:100',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        }

        $province = Province::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Province created successfully',
            'data' => $province,
        ], 201);
    }

    /**
     * Display the specified province.
     * GET /api/provinsi/{id}
     */
    public function show(string $id): JsonResponse
    {
        $province = Province::find($id);

        if (!$province) {
            return response()->json([
                'success' => false,
                'message' => 'Province not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Province detail',
            'data' => $province,
        ], 200);
    }

    /**
     * Update the specified province.
     * PUT /api/provinsi/{id}
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $province = Province::find($id);

        if (!$province) {
            return response()->json([
                'success' => false,
                'message' => 'Province not found',
            ], 404);
        }

        try {
            $validated = $request->validate([
                'code' => 'sometimes|required|string|max:10|unique:provinces,code,' . $id,
                'name' => 'sometimes|required|string|max:100',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        }

        $province->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Province updated successfully',
            'data' => $province,
        ], 200);
    }

    /**
     * Remove the specified province.
     * DELETE /api/provinsi/{id}
     */
    public function destroy(string $id): JsonResponse
    {
        $province = Province::find($id);

        if (!$province) {
            return response()->json([
                'success' => false,
                'message' => 'Province not found',
            ], 404);
        }

        $province->delete();

        return response()->json([
            'success' => true,
            'message' => 'Province deleted successfully',
        ], 200);
    }
}
