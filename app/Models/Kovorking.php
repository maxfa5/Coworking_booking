<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Kovorking extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['name','type_id','from_at','to_at','floor_number', 'metadata','capacity',  'picture_url','timezone'];
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'kovorking_id');
    }
}
