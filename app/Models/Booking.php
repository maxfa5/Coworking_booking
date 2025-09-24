<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['start_time','end_time','period_start_at','day_of_week','period_end_at', 'type'];

    public function kovorking(): BelongsTo
    {
        return $this->belongsTo(Kovorking::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
