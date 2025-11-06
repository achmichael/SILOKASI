<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alternative extends Model
{
    protected $table = 'alternatives';
    
    protected $fillable = [
        'code',
        'name',
        'description'
    ];
    
    public $timestamps = true;
    
    /**
     * Get all pairwise comparisons for this alternative.
     */
    public function pairwiseComparisons1(): HasMany
    {
        return $this->hasMany(PairwiseComparisonAlternative::class, 'alternative_id_1');
    }
    
    public function pairwiseComparisons2(): HasMany
    {
        return $this->hasMany(PairwiseComparisonAlternative::class, 'alternative_id_2');
    }
    
    /**
     * Get ANP weights for this alternative.
     */
    public function anpWeights(): HasMany
    {
        return $this->hasMany(AnpAlternativeWeight::class, 'alternative_id');
    }
    
    /**
     * Get DM rankings for this alternative.
     */
    public function dmRankings(): HasMany
    {
        return $this->hasMany(DmRanking::class, 'alternative_id');
    }
    
    /**
     * Get Borda results for this alternative.
     */
    public function bordaResult()
    {
        return $this->hasOne(BordaResult::class, 'alternative_id');
    }
}
