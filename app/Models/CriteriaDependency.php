<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CriteriaDependency extends Model
{
    protected $table = 'criteria_dependencies';
    
    protected $fillable = [
        'criteria_id_from',
        'criteria_id_to',
        'dependency_value'
    ];
    
    public $timestamps = true;
    
    protected $casts = [
        'dependency_value' => 'float'
    ];
    
    /**
     * Get the source criteria.
     */
    public function criteriaFrom(): BelongsTo
    {
        return $this->belongsTo(Criteria::class, 'criteria_id_from');
    }
    
    /**
     * Get the target criteria.
     */
    public function criteriaTo(): BelongsTo
    {
        return $this->belongsTo(Criteria::class, 'criteria_id_to');
    }
}
