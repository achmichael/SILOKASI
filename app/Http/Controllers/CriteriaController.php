<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the criteria.
     */
    public function index(): JsonResponse
    {
        try {
            $criteria = Criteria::orderBy('created_at', 'desc')->get();
            
            return response()->json([
                'success' => true,
                'message' => 'Criteria retrieved successfully',
                'data' => $criteria
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve criteria',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created criteria.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'code' => 'required|string|max:10|unique:criteria,code',
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

            $criteria = Criteria::create([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Criteria created successfully',
                'data' => $criteria
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create criteria',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified criteria.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $criteria = Criteria::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'message' => 'Criteria retrieved successfully',
                'data' => $criteria
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Criteria not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve criteria',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified criteria.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $criteria = Criteria::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'code' => 'sometimes|required|string|max:10|unique:criteria,code,' . $id,
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

            $criteria->update($request->only(['code', 'name', 'description']));

            return response()->json([
                'success' => true,
                'message' => 'Criteria updated successfully',
                'data' => $criteria
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Criteria not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update criteria',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified criteria.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $criteria = Criteria::findOrFail($id);
            $criteria->delete();

            return response()->json([
                'success' => true,
                'message' => 'Criteria deleted successfully'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Criteria not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete criteria',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
