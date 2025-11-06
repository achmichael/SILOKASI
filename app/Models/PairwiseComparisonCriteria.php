<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PairwiseComparisonCriteria extends Model
{
    protected $table = 'pairwise_comparisons_criteria';
    
    protected $fillable = [
        'user_id',
        'criteria_id_1',
        'criteria_id_2',
        'comparison_value'
    ];
    
    public $timestamps = true;
    
    protected $casts = [
        'comparison_value' => 'float'
    ];
    
    /**
     * Get the user (Decision Maker) who made this comparison.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the first criteria being compared.
     */
    public function criteria1(): BelongsTo
    {
        return $this->belongsTo(Criteria::class, 'criteria_id_1');
    }
    
    /**
     * Get the second criteria being compared.
     */
    public function criteria2(): BelongsTo
    {
        return $this->belongsTo(Criteria::class, 'criteria_id_2');
    }
}
