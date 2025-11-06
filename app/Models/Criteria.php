<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Criteria extends Model
{
    protected $table = 'criteria';
    
    protected $fillable = [
        'code',
        'name',
        'description'
    ];
    
    public $timestamps = true;
    
    /**
     * Get all pairwise comparisons for this criteria.
     */
    public function pairwiseComparisons1(): HasMany
    {
        return $this->hasMany(PairwiseComparisonCriteria::class, 'criteria_id_1');
    }
    
    public function pairwiseComparisons2(): HasMany
    {
        return $this->hasMany(PairwiseComparisonCriteria::class, 'criteria_id_2');
    }
    
    /**
     * Get criteria weights for this criteria.
     */
    public function weights(): HasMany
    {
        return $this->hasMany(AnpCriteriaWeight::class, 'criteria_id');
    }
    
    /**
     * Get dependencies where this criteria is the source.
     */
    public function dependenciesFrom(): HasMany
    {
        return $this->hasMany(CriteriaDependency::class, 'criteria_id_from');
    }
    
    /**
     * Get dependencies where this criteria is the target.
     */
    public function dependenciesTo(): HasMany
    {
        return $this->hasMany(CriteriaDependency::class, 'criteria_id_to');
    }
}
