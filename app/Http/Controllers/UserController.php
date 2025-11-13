<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Return a lightweight list of users for dashboard consumption.
     */
    public function index(): JsonResponse
    {
        try {
            $users = User::orderByDesc('created_at')
                ->get()
                ->map(function (User $user) {
                    $createdAt = $user->created_at;

                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                        'initials' => $this->extractInitials($user->name),
                        'created_at' => optional($createdAt)->toIso8601String(),
                        'created_at_human' => optional($createdAt)->diffForHumans(),
                    ];
                });

            $roleBreakdown = User::select('role', DB::raw('COUNT(*) as total'))
                ->groupBy('role')
                ->pluck('total', 'role');

            return response()->json([
                'success' => true,
                'message' => 'Users retrieved successfully',
                'data' => [
                    'users' => $users,
                    'meta' => [
                        'total' => $users->count(),
                        'role_counts' => $roleBreakdown,
                    ],
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve users',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    private function extractInitials(?string $name): string
    {
        if (empty($name)) {
            return 'DM';
        }

        $parts = preg_split('/\s+/', trim($name));
        $initials = collect($parts)
            ->filter()
            ->take(2)
            ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
            ->implode('');

        return $initials !== '' ? $initials : 'DM';
    }
}
