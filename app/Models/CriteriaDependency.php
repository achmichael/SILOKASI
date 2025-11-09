<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CriteriaDependency extends Model
{
    use HasUuids;

    protected $table = 'criteria_dependencies';
    
    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';
    
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
