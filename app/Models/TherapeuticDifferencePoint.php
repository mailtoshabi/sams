<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TherapeuticDifferencePoint extends Model
{
    protected $fillable = ['therapeutic_difference_id', 'medicine_1_description', 'medicine_2_description', 'point_number'];

    public function therapeuticDifference()
    {
        return $this->belongsTo(TherapeuticDifference::class);
    }
}
