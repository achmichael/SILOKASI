<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BordaResult extends Model
{
    use HasUuids;

    protected $table = 'borda_results';
    
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'alternative_id',
        'borda_points',
        'final_rank'
    ];
    
    public $timestamps = true;
    
    protected $casts = [
        'borda_points' => 'float',
        'final_rank' => 'integer'
    ];
    
    /**
     * Get the alternative for this Borda result.
     */
    public function alternative(): BelongsTo
    {
        return $this->belongsTo(Alternative::class);
    }
}
