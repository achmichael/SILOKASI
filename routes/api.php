<?php

use App\Http\Controllers\AlternativeComparisonController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsensusController;
use App\Http\Controllers\CriteriaComparisonController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/refresh-token', [AuthController::class, 'refresh']);
    Route::post('/revoke-all-tokens', [AuthController::class, 'revokeAll']);
    
    Route::prefix('/criteria-comparison')->group(function () {
        Route::post('/comparisons', [CriteriaComparisonController::class, 'storeComparisons']);
        Route::post('/calculate-weights', [CriteriaComparisonController::class, 'calculateWeights']);
        Route::get('/weights/{userId}', [CriteriaComparisonController::class, 'getWeights']);
        Route::get('/comparisons/{userId}', [CriteriaComparisonController::class, 'getComparisons']);
        Route::get('/aggregated-weights', [CriteriaComparisonController::class, 'calculateAggregatedWeights']);
    });

    Route::prefix('/alternative-comparison')->group(function () {
        Route::post('/comparisons', [AlternativeComparisonController::class, 'storeComparisons']);
        Route::post('/calculate-local-weights', [AlternativeComparisonController::class, 'calculateLocalWeights']);
        Route::post('/calculate-final-weights', [AlternativeComparisonController::class, 'calculateFinalWeights']);
        Route::get('/final-weights/{userId}', [AlternativeComparisonController::class, 'getFinalWeights']);
        Route::get('/comparisons/{userId}/{criteriaId}', [AlternativeComparisonController::class, 'getComparisons']);
        Route::post('/calculate-all-weights', [AlternativeComparisonController::class, 'calculateAllWeights']);
    });

    Route::prefix('/consensus')->group(function () {
        Route::post('/generate-rankings', [ConsensusController::class, 'generateRankings']);
        Route::post('/calculate-borda', [ConsensusController::class, 'calculateBordaConsensus']);
        Route::post('/calculate-borda-with-ties', [ConsensusController::class, 'calculateBordaConsensusWithTieHandling']);
        Route::get('/results', [ConsensusController::class, 'getConsensusResults']);
        Route::get('/dm-rankings/{userId}', [ConsensusController::class, 'getDMRankings']);
        Route::get('/detailed-comparison', [ConsensusController::class, 'getDetailedComparison']);
        Route::post('/execute-complete', [ConsensusController::class, 'executeCompleteConsensus']);
    });
});
