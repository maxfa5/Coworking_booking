<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking`` extends Model
{
    protected $table = 'objects_types';

    protected $primaryKey = 'id';
    protected $fillable = ['name','min_slot','max_slot','slot_step'];

}
