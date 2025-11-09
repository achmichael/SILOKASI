<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DmRanking extends Model
{
    use HasUuids;

    protected $table = 'dm_rankings';
    
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'user_id',
        'alternative_id',
        'rank'
    ];
    
    public $timestamps = true;
    
    protected $casts = [
        'rank' => 'integer'
    ];
    
    /**
     * Get the user (Decision Maker) for this ranking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the alternative for this ranking.
     */
    public function alternative(): BelongsTo
    {
        return $this->belongsTo(Alternative::class);
    }
}
