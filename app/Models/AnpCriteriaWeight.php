<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnpCriteriaWeight extends Model
{
    use HasUuids;

    protected $table = 'anp_criteria_weights';
    
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'user_id',
        'criteria_id',
        'weight'
    ];
    
    public $timestamps = true;
    
    protected $casts = [
        'weight' => 'float'
    ];
    
    /**
     * Get the user (Decision Maker) for this weight.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the criteria for this weight.
     */
    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }
}
