<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PairwiseComparisonAlternative extends Model
{
    protected $table = 'pairwise_comparisons_alternatives';
    
    protected $fillable = [
        'user_id',
        'criteria_id',
        'alternative_id_1',
        'alternative_id_2',
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
     * Get the criteria for this comparison.
     */
    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }
    
    /**
     * Get the first alternative being compared.
     */
    public function alternative1(): BelongsTo
    {
        return $this->belongsTo(Alternative::class, 'alternative_id_1');
    }
    
    /**
     * Get the second alternative being compared.
     */
    public function alternative2(): BelongsTo
    {
        return $this->belongsTo(Alternative::class, 'alternative_id_2');
    }
}
