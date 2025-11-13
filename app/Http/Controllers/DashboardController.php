<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\AnpAlternativeWeight;
use App\Models\BordaResult;
use App\Models\Criteria;
use App\Models\PairwiseComparisonAlternative;
use App\Models\PairwiseComparisonCriteria;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    /**
     * Provide a high level summary for the dashboard widgets and charts.
     */
    public function summary(): JsonResponse
    {
        try {
            $totals = [
                'users' => User::count(),
                'criteria' => Criteria::count(),
                'alternatives' => Alternative::count(),
                'criteria_comparisons' => PairwiseComparisonCriteria::count(),
                'alternative_comparisons' => PairwiseComparisonAlternative::count(),
                'anp_weights' => AnpAlternativeWeight::count(),
                'consensus_results' => BordaResult::count(),
            ];

            $totals['comparisons'] = $totals['criteria_comparisons'] + $totals['alternative_comparisons'];

            $activityWindowStart = Carbon::today()->subDays(6);

            $criteriaDaily = PairwiseComparisonCriteria::whereDate('created_at', '>=', $activityWindowStart)
                ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->groupBy('date')
                ->pluck('total', 'date');

            $alternativeDaily = PairwiseComparisonAlternative::whereDate('created_at', '>=', $activityWindowStart)
                ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->groupBy('date')
                ->pluck('total', 'date');

            $weightDaily = AnpAlternativeWeight::whereDate('created_at', '>=', $activityWindowStart)
                ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->groupBy('date')
                ->pluck('total', 'date');

            $activityLabels = [];
            $activityValues = [];

            for ($daysAgo = 6; $daysAgo >= 0; $daysAgo--) {
                $currentDate = Carbon::today()->subDays($daysAgo);
                $dateKey = $currentDate->toDateString();

                $activityLabels[] = $currentDate->format('d M');
                $activityValues[] = ($criteriaDaily[$dateKey] ?? 0)
                    + ($alternativeDaily[$dateKey] ?? 0)
                    + ($weightDaily[$dateKey] ?? 0);
            }

            $approved = $totals['consensus_results'];
            $pending = max($totals['anp_weights'] - $approved, 0);
            $rejected = max($totals['alternatives'] - ($approved + $pending), 0);

            $recentActivities = $this->buildRecentActivityTimeline();

            return response()->json([
                'success' => true,
                'message' => 'Dashboard summary generated successfully',
                'data' => [
                    'totals' => $totals,
                    'activity' => [
                        'labels' => $activityLabels,
                        'values' => $activityValues,
                    ],
                    'status_distribution' => [
                        'approved' => $approved,
                        'pending' => $pending,
                        'rejected' => $rejected,
                    ],
                    'recent_activity' => $recentActivities,
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to build dashboard summary',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Build a concise activity timeline from different subsystems.
     */
    protected function buildRecentActivityTimeline(): Collection
    {
        $activities = collect();

        $activities = $activities->concat(
            Alternative::latest('updated_at')
                ->take(4)
                ->get()
                ->map(function (Alternative $alternative) {
                    $timestamp = $alternative->updated_at ?? $alternative->created_at;

                    return [
                        'title' => $alternative->name,
                        'subtitle' => $alternative->code,
                        'decision_maker' => null,
                        'action' => 'Alternatif dibuat',
                        'status' => 'approved',
                        'status_label' => 'Approved',
                        'timestamp' => $timestamp,
                    ];
                })
        );

        $activities = $activities->concat(
            Criteria::latest('updated_at')
                ->take(4)
                ->get()
                ->map(function (Criteria $criteria) {
                    $timestamp = $criteria->updated_at ?? $criteria->created_at;

                    return [
                        'title' => $criteria->name,
                        'subtitle' => $criteria->code,
                        'decision_maker' => null,
                        'action' => 'Kriteria ditambahkan',
                        'status' => 'approved',
                        'status_label' => 'Approved',
                        'timestamp' => $timestamp,
                    ];
                })
        );

        $activities = $activities->concat(
            PairwiseComparisonAlternative::with(['user', 'criteria', 'alternative1', 'alternative2'])
                ->latest('updated_at')
                ->take(4)
                ->get()
                ->map(function (PairwiseComparisonAlternative $comparison) {
                    $timestamp = $comparison->updated_at ?? $comparison->created_at;

                    $title = $comparison->criteria?->name ?? 'Perbandingan Alternatif';
                    $subtitle = collect([
                        $comparison->alternative1?->code,
                        $comparison->alternative2?->code,
                    ])->filter()->implode(' vs ');

                    return [
                        'title' => $title,
                        'subtitle' => $subtitle,
                        'decision_maker' => $comparison->user?->name,
                        'action' => 'Perbandingan alternatif diperbarui',
                        'status' => 'pending',
                        'status_label' => 'Pending',
                        'timestamp' => $timestamp,
                    ];
                })
        );

        $activities = $activities->concat(
            BordaResult::with('alternative')
                ->latest('updated_at')
                ->take(4)
                ->get()
                ->map(function (BordaResult $result) {
                    $timestamp = $result->updated_at ?? $result->created_at;

                    return [
                        'title' => $result->alternative?->name ?? 'Hasil Konsensus',
                        'subtitle' => $result->alternative?->code,
                        'decision_maker' => null,
                        'action' => 'Konsensus BORDA dihitung',
                        'status' => 'approved',
                        'status_label' => 'Approved',
                        'timestamp' => $timestamp,
                    ];
                })
        );

        return $activities
            ->filter(fn ($item) => !empty($item['timestamp']))
            ->sortByDesc('timestamp')
            ->take(8)
            ->map(function (array $item) {
                $timestamp = $item['timestamp'] instanceof Carbon
                    ? $item['timestamp']
                    : Carbon::parse($item['timestamp']);

                return [
                    'title' => $item['title'],
                    'subtitle' => $item['subtitle'],
                    'decision_maker' => $item['decision_maker'],
                    'action' => $item['action'],
                    'status' => $item['status'],
                    'status_label' => $item['status_label'],
                    'timestamp' => $timestamp->toIso8601String(),
                    'time_ago' => $timestamp->diffForHumans(),
                ];
            })
            ->values();
    }
}
