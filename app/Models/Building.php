<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Building extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['name','count_floor','city_id','open_at','close_at','address', 'timezone'];
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function kovorkings(): HasMany
    {
        return $this->hasMany(Kovorking::class);
    }
}
