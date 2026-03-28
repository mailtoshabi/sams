<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TherapeuticDifference extends Model
{
    protected $fillable = ['introduction', 'medicine_1_id', 'medicine_2_id'];

    public function medicine1()
    {
        return $this->belongsTo(Medicine::class, 'medicine_1_id');
    }

    public function medicine2()
    {
        return $this->belongsTo(Medicine::class, 'medicine_2_id');
    }

    public function points()
    {
        return $this->hasMany(TherapeuticDifferencePoint::class)->orderBy('point_number');
    }
}
