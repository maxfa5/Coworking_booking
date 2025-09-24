<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'timezone'];

    public function buildings(): HasMany
    {
        return $this->hasMany(Building::class);
    }

}
