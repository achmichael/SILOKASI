<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class AlternativeController extends Controller
{
    /**
     * Display a listing of the alternatives.
     */
    public function index(): JsonResponse
    {
        try {
            $alternatives = Alternative::orderBy('created_at', 'desc')->get();
            
            return response()->json([
                'success' => true,
                'message' => 'Alternatives retrieved successfully',
                'data' => $alternatives
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve alternatives',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created alternative.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'code' => 'required|string|max:10|unique:alternatives,code',
                'name' => 'required|string|max:100',
                'description' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $alternative = Alternative::create([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Alternative created successfully',
                'data' => $alternative
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create alternative',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified alternative.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $alternative = Alternative::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'message' => 'Alternative retrieved successfully',
                'data' => $alternative
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Alternative not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve alternative',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified alternative.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $alternative = Alternative::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'code' => 'sometimes|required|string|max:10|unique:alternatives,code,' . $id,
                'name' => 'sometimes|required|string|max:100',
                'description' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $alternative->update($request->only(['code', 'name', 'description']));

            return response()->json([
                'success' => true,
                'message' => 'Alternative updated successfully',
                'data' => $alternative
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Alternative not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update alternative',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified alternative.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $alternative = Alternative::findOrFail($id);
            $alternative->delete();

            return response()->json([
                'success' => true,
                'message' => 'Alternative deleted successfully'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Alternative not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete alternative',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
